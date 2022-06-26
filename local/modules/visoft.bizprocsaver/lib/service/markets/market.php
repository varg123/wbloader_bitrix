<?php


namespace ViSoft\BizProcSaver\Service\Markets;


use Bitrix\Main\DB\Exception;
use ViSoft\BizProcSaver\Service\Creater\Fabric\CardFabric;
use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;
use ViSoft\BizProcSaver\Service\Parser\MarketParser;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Find;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Price;
use ViSoft\BizProcSaver\Service\WBApi\WBQuery;
use ViSoft\BizProcSaver\Tables\CardsTable;

abstract class Market// implements IMarket
{

    abstract function getWarehouseIds(): array ;

    abstract function getId(): string;

    abstract function changeOffer($offer): Offer;

    abstract function getToken(): string;

    abstract function getWarehouseId(): int;

    /**
     * @param $query WBQuery
     * @throws \Exception
     */
    function findCardByBarcode($query, $barcode)
    {
        $find = new Find([
            'column' => "nomenclatures.variations.barcode",
            'search' => $barcode
        ]);
        return current($query->cardList([$find]));
    }

    /**
     * @param $query WBQuery
     * @throws \Exception
     */
    function findCardByVendorCode($query, $vendorCode)
    {
        $find = new Find([
            'column' => "nomenclatures.vendorCode",
            'search' => $vendorCode
        ]);
        return current($query->cardList([$find]));
    }

    function loadCard()
    {
        $wbId = $this->getId();
        $marketParser = new MarketParser($wbId);
        $cardCreator = new CardFabric();
        $wbRequest = new WBQuery($this->getToken());
        foreach ($marketParser->getOffer() as $offer) {
            $offerObject = clone $offer;
            [$barcode, $vendorCode, $nmId] = CardsTable::getIds(static::getId(), $offer->id);
            /**
             * @var $card Card
             * @var $offerObject Offer
             */
            $card = null;
            try {
                $vendorCode = $offerObject->vendorCode;
                if ($vendorCode) {
                    $cardRes = $this->findCardByVendorCode($wbRequest, $vendorCode);
                    if ($cardRes) $card = $cardRes;
                }
                if (is_null($card)) {
                    if (is_null($offerObject->barcode)) {
                        $barcode = current($wbRequest->getBarcodes(1));
                        if ($barcode) {
                            $offerObject->barcode = $barcode;
                        }
                        $card = $cardCreator->createCard($offerObject);
                        $wbRequest->cardCreate($card);
                    }
                } elseif ($card) {
                    if (is_null($offerObject->barcode)) {
                        $barcode = current(current($card->nomenclatures)->variations)->barcode;
                        $barcode = $barcode ? $barcode : current(current($card->nomenclatures)->variations)->barcodes[0];
                        if ($barcode) {
                            $offerObject->barcode = $barcode;
                        }
                        $cardCreator->updateCard($card, $offerObject);
                        $wbRequest->cardUpdate($card);
                    }
                }
                if ($card) {
                    $vendorCode = current($card->nomenclatures)->vendorCode;
                    $barcode = current(current($card->nomenclatures)->variations)->barcode;
                    $barcode = $barcode ? $barcode : current(current($card->nomenclatures)->variations)->barcodes[0];
                    $nmId = current($card->nomenclatures)->nmId;
                    $nmId = $nmId ? $nmId : 0;
                    /**
                     * @var $offer Offer
                     */
                    CardsTable::setIds(static::getId(), $offer->id, $nmId, $barcode, $vendorCode);
                }
            } catch (\Exception $e) {
                /**
                 * @var $offer Offer
                 */
                CardsTable::setError(static::getId(), $offer->id, $e->getMessage());
            }
        }
    }


    function loadPrices()
    {
        $limit = 1000;
        $offset = 0;
        $count = CardsTable::getList([
            'select' =>
                [
                    'nmId',
                    'price',
                ],
            'filter' => [
                '!nmId' => false,
                '=wbId' => static::getId(),
            ],
        ])->getSelectedRowsCount();
        $wbRequest = new WBQuery($this->getToken());
        while (true) {
            $products = CardsTable::getList([
                'select' =>
                    [
                        'nmId',
                        'price',
                    ],
                'filter' => [
                    '!nmId' => false,
                    '=wbId' => static::getId(),
                ],
                'offset' => $offset,
                'limit' => $limit
            ])->fetchAll();
            if ($offset > $count) break;
            $offset += $limit;

            $prices=[];
            foreach ($products as $price) {
                $prices[] = new Price([
                    'price' => (int)$price['price'],
                    'nmId' => (string)$price['nmId'],
                ]);
            }
            try {
                $wbRequest->prices($prices);
            } catch (\Exception $e) {
                \CEventLog::Add([
                    "SEVERITY" => "SECURITY",
                    "AUDIT_TYPE_ID" => "WB_ERROR",
                    "MODULE_ID" => "main",
                    "ITEM_ID" => static::getId(),
                    "DESCRIPTION" => $e->getMessage(),
                ]);
            }
        }

    }

    function loadOutlets()
    {
        $limit = 1000;
        $offset = 0;
        $count = CardsTable::getList([
            'select' =>
                [
                    'wbId',
                    'outlet',
                    'barcode',
                ],
            'filter' => [
                '!barcode' => false,
                '=wbId' => static::getId(),
            ],
        ])->getSelectedRowsCount();
        $wbRequest = new WBQuery($this->getToken());
        while (true) {
            $products = CardsTable::getList([
                'select' =>
                    [
                        'wbId',
                        'outlet',
                        'barcode',
                    ],
                'filter' => [
                    '!barcode' => false,
                    '=wbId' => static::getId(),
                ],
                'offset' => $offset,
                'limit' => $limit
            ])->fetchAll();
            if ($offset > $count) break;
            $offset += $limit;
            $stocks = [];
            foreach ($products as $product) {
                $stocks[] = [
                    'stock' => (int)$product['outlet'],
                    'barcode' => (string)$product['barcode'],
                ];
            }
            foreach (static::getWarehouseIds() as $warehouseId) {
                try {
                    $wbRequest->stocks($warehouseId, $stocks);
                } catch (\Exception $e) {
                    \CEventLog::Add([
                        "SEVERITY" => "SECURITY",
                        "AUDIT_TYPE_ID" => "errorOutlets",
                        "MODULE_ID" => "main",
                        "ITEM_ID" => static::getId(),
                        "DESCRIPTION" => $e->getMessage(),
                    ]);
                }
            }
        }
    }

}
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
                if ($barcode) {
                    $card = $this->findCardByBarcode($wbRequest, $barcode);
                }
                if (is_null($card) and $vendorCode) {
                    $card = $this->findCardByVendorCode($wbRequest, $vendorCode);
                }
                if (!$barcode and !$vendorCode and is_null($card)) {
                    if (is_null($offerObject->barcode)) {
                        $offerObject->barcode = current($wbRequest->getBarcodes(1));
                    }
                    //todo: добавить эксепшены в методе
                    $card = $cardCreator->createCard($offerObject);

                    $wbRequest->cardCreate($card);
                } elseif ($card) {
                    $card = $cardCreator->updateCard($card, $offerObject);
                    $wbRequest->cardUpdate($card);
                } else {
                    throw new Exception("Карточка пропала после обновления");
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
                } else {
                    throw new Exception("Карточка не найдена после создания");
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
        $res = CardsTable::getList([
            'select' =>
                [
                    'price',
                    'nmId',
                ],
            'filter' => [
                '!nmId' => false,
                '=wbId' => static::getId(),
            ],
        ]);
        $prices = [];
        while ($priceData = $res->fetch()) {
            $prices[] = new Price([
                'price' => (int)$priceData['price'],
                'nmId' => (string)$priceData['nmId'],
            ]);
        }
        $wbRequest = new WBQuery($this->getToken());
        try {
            $wbRequest->prices([$prices]);
        } catch (\Exception $e) {
            \CEventLog::Add([
                "SEVERITY" => "SECURITY",
                "AUDIT_TYPE_ID" => "MY_OWN_TYPE",
                "MODULE_ID" => "main",
                "ITEM_ID" => static::getId(),
                "DESCRIPTION" => $e->getMessage(),
            ]);
        }
    }

    function loadOutlets()
    {
        $res = CardsTable::getList([
            'select' =>
                [
                    'outlet',
                    'barcode',
                ],
            'filter' => [
                '!nmId' => false,
                '=wbId' => static::getId(),
            ],
        ]);
        $stocks = [];
        while ($priceData = $res->fetch()) {
            $stocks[] = [
                'outlet' => (int)$priceData['outlet'],
                'barcode' => (string)$priceData['barcode'],
                'warehouseId' => static::getWarehouseId(),
            ];
        }
        $wbRequest = new WBQuery($this->getToken());
        foreach (array_chunk($stocks, 1000) as $stocksGroup) {
            try {
                $wbRequest->stocks(static::getWarehouseId(), $stocksGroup);
            } catch (\Exception $e) {
                \CEventLog::Add([
                    "SEVERITY" => "SECURITY",
                    "AUDIT_TYPE_ID" => "OUTLET_ERROR",
                    "MODULE_ID" => "main",
                    "ITEM_ID" => static::getId(),
                    "DESCRIPTION" => $e->getMessage(),
                ]);
            }
        }
    }

}
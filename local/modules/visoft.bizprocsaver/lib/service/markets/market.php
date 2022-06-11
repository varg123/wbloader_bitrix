<?php


namespace ViSoft\BizProcSaver\Service\Markets;


use Bitrix\Main\DB\Exception;
use ViSoft\BizProcSaver\Service\Creater\Fabric\CardFabric;
use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;
use ViSoft\BizProcSaver\Service\Parser\MarketParser;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Find;
use ViSoft\BizProcSaver\Service\WBApi\WBQuery;
use ViSoft\BizProcSaver\Tables\CardsTable;

abstract class Market// implements IMarket
{

    abstract function getId(): string;

    abstract function changeOffer($offer): Offer;


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
    function findCardByVendorCode($query, $vendorCode): array
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
            [$barcode, $vendorCode] = CardsTable::getIds(static::getId(), $offer->id);
            /**
             * @var $card Card
             */
            $card = null;
            try {
                if ($barcode) {
                    $card = $this->findCardByBarcode($wbRequest, $barcode);
                }
                if (is_null($card) and $vendorCode) {
                    $card = $this->findCardByVendorCode($wbRequest, $vendorCode);
                }

                if ((!$barcode or !$vendorCode) and $card) {
                    //todo: добавить эксепшены в методе
                    $card = $cardCreator->createCard($offerObject);
                    $wbRequest->cardCreate($card);
                } elseif ($card) {
                    $card = $cardCreator->updateCard($card, $offerObject);
                    $wbRequest->cardUpdate($card);
                } else {
                    throw new Exception("Карточка пропала после обновления");
                }

                $vendorCode = current($card->nomenclatures)->vendorCode;
                $barcode = current(current($card->nomenclatures)->variations)->barcodes[0];
                $card = null;
                if ($barcode) {
                    $card = $this->findCardByBarcode($wbRequest, $barcode);
                }
                if (is_null($card) and $vendorCode) {
                    $card = $this->findCardByVendorCode($wbRequest, $vendorCode);
                }
                if ($card) {
                    $nmId = current($card->nomenclatures)->nmId;
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


    function getConfig(): array
    {
        return [
            'key' => '123',
            'strockId' => 123123,
        ];
    }

    abstract function getToken(): string;
}
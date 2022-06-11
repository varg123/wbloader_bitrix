<?php


namespace ViSoft\BizProcSaver\Service\Markets;


use ViSoft\BizProcSaver\Service\Creater\Fabric\CardFabric;
use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;
use ViSoft\BizProcSaver\Service\Parser\MarketParser;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Find;
use ViSoft\BizProcSaver\Service\WBApi\WBQuery;

abstract class Market// implements IMarket
{

    abstract function getId(): string;

    abstract function changeOffer($offer): Offer;


    /**
     * @param $query WBQuery
     */
    function findCardByBarcode($query, $barcode)
    {
        $find = new Find([
            'column' => "nomenclatures.variations.barcode",
            'search' => $barcode
        ]);
        return current($query->cardList([$find]));
    }

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
            [$offerObject, $barcode, $nmId] = $offer;
            $card = null;
            if ($barcode) {
                $card = $this->findCardByBarcode($wbRequest, $barcode);
            }
//            if (is_null($card) and $nmId) {
//                $card = $this->findCardByVendorCode($wbRequest, $nmId);
//            }
            if ($card) {
                $card = $cardCreator->updateCard($card,$offerObject);
                $result = $wbRequest->cardUpdate($card);
            } else {
                $card = $cardCreator->createCard($offerObject);
                $result = $wbRequest->cardCreate($card);
                pre($result);
//                pre(current($card->nomenclatures)->nmId);
//                pre($card);
//                die();
            }
            die();
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
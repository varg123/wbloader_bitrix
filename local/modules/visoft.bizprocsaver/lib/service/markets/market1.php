<?php


namespace ViSoft\BizProcSaver\Service\Markets;


use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;

class Market1 extends Market
{

    /**
     * @param $offer Offer
     * @return Offer
     */
    function changeOffer($offer): Offer
    {

        $offer->vendorCode = 'testq' . $offer->product_ean;
        $offer->vendorCodeSupplier = 'testqs' . $offer->product_ean;
        if ($offer->price < 100) {
            $offer->price = $offer->price + $offer->price * 3.5;
        } elseif ($offer->price < 400) {
            $offer->price = $offer->price + $offer->price * 3;
        } elseif ($offer->price < 700) {
            $offer->price = $offer->price + $offer->price * 2;
        } elseif ($offer->price < 850) {
            $offer->price = $offer->price + $offer->price * 1.5;
        } elseif ($offer->price < 1000) {
            $offer->price = $offer->price + $offer->price * 1;
        } elseif ($offer->price < 1000) {
            $offer->price = $offer->price + $offer->price * 1;
        } elseif ($offer->price < 1250) {
            $offer->price = $offer->price + $offer->price * 0.8;
        } elseif ($offer->price < 1500) {
            $offer->price = $offer->price + $offer->price * 0.7;
        } elseif ($offer->price < 1750) {
            $offer->price = $offer->price + $offer->price * 0.6;
        } elseif ($offer->price < 2000) {
            $offer->price = $offer->price + $offer->price * 0.5;
        }
        return $offer;
    }

    function getId(): string
    {
        return 'wb1';
    }

    function getToken(): string
    {
//        \COption::GetOptionString('visoft.pizprocsaver', 'key.'.self::getId());
        return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhY2Nlc3NJRCI6IjIzNTMyOTIzLTY0MjgtNDI3Ny1hODY2LWY3ZTk0NzJjYTMyNiJ9.myxXRKj4Tavq75fe7VqgWqH0pNc3iH3vC3TNPgmBrpc';
    }

    function getWarehouseId(): int
    {
//        \COption::GetOptionString('visoft.pizprocsaver', 'warehouse.'.self::getId());
        return 110;
    }
}
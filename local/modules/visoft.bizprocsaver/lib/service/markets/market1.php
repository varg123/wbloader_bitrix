<?php


namespace ViSoft\BizProcSaver\Service\Markets;


use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;

class Market1 implements IMarket
{

    function changeOffer($offer): Offer
    {
        $offer->price = $offer->price*2;
        return $offer;
    }

    function getId(): string
    {
        return 'wb2';
    }

    function getConfig(): array
    {
        return [
            'key' => '123',
            'strockId' => 123123,
        ];
    }
}
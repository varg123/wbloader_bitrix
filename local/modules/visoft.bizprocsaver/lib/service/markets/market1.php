<?php


namespace ViSoft\BizProcSaver\Service\Markets;


use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;

class Market1 extends Market
{

    function changeOffer($offer): Offer
    {
        $offer->price = $offer->price*2;
        return $offer;
    }

    function getId(): string
    {
        return 'wb1';
    }

    function getConfig(): array
    {
        return [
            'key' => '123',
            'strockId' => 123123,
        ];
    }

    function getToken(): string
    {
        return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhY2Nlc3NJRCI6IjllM2I4NWVkLTQwN2QtNDdmNC1hYWM0LThmYzU0ZWJjZDNiNiJ9.ap7rjYDyGfCbnz0UIaWmJQxdstIDPFNHaRS8zu3W44Q';
    }
}
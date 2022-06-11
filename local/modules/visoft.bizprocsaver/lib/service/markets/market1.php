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
        return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhY2Nlc3NJRCI6IjIzNTMyOTIzLTY0MjgtNDI3Ny1hODY2LWY3ZTk0NzJjYTMyNiJ9.myxXRKj4Tavq75fe7VqgWqH0pNc3iH3vC3TNPgmBrpc';
    }

    function getWarehouseId(): int
    {
        return 110;
    }
}
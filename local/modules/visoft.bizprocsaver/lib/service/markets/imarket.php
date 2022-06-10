<?php


namespace ViSoft\BizProcSaver\Service\Markets;

use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;

interface IMarket
{
    /**
     * @param $offer Offer
     * @return Offer
     */
    function changeOffer($offer): Offer;
    function getId(): string;
    function getConfig(): array;
}
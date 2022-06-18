<?php

namespace ViSoft\BizProcSaver\Service\Markets;

use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;
use ViSoft\BizProcSaver\Service\Parser\JoomlaParser;
use ViSoft\BizProcSaver\Tables\OfferTable;

class Markets
{
    public function getMarkets(): array
    {
        return [
            new \ViSoft\BizProcSaver\Service\Markets\Market1(),//ООО Маркетплейс
            new \ViSoft\BizProcSaver\Service\Markets\Market2(),//Качусов
        ];
    }

    public static function loadOffers()
    {
        $parser = new JoomlaParser();
        foreach ($parser->getOffer() as $offer) {
            OfferTable::saveOffer($offer);
        }
    }

    public static function resetUpdate()
    {
        global $DB;
        $DB->Query('update b_wb_offers set is_update="N"');
    }
}
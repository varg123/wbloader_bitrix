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
            new \ViSoft\BizProcSaver\Service\Markets\Market1(),
        ];
    }

    public static function loadOffers()
    {
        $parser = new JoomlaParser();
        $i=0;
        $cnt=0;
        foreach ($parser->getOffer() as $offer) {
            OfferTable::saveOffer($offer);
            $i++;
            if($i>$cnt) break;
        }
    }
}
<?php

namespace ViSoft\BizProcSaver\Service\Parser;

use ViSoft\BizProcSaver\Service\Creater\Offer;
use ViSoft\BizProcSaver\Tables\CardsTable;

class MarketParser implements Offer\IGetOffer
{

    private $wbId = null;

    public function __construct($wbId)
    {
        $this->wbId = $wbId;
    }

    public function getOffer(): \Generator
    {
        $req = CardsTable::getList([
            'select' => [
                '*',
                'OFFER.is_update'
            ],
            'filter' => [
                '=wbId' => $this->wbId,
                '=OFFER.is_update' => 'Y'
            ],
        ]);
        while ($product = $req->fetch()) {
            $offerObj = unserialize($product['data']);
            $offerObj = $this->convertOffer($offerObj);
            if ($this->filterOffers($offerObj)) {
                yield $offerObj;
            }
        }
    }

    /**
     *
     * @param $offerObj Offer\Offer
     * @return bool
     */
    protected function filterOffers($offerObj): bool
    {
        return true;
    }

    protected function convertOffer(Offer\Offer $offerObj)
    {
        return $offerObj;
    }
}
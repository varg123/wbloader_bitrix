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

    public function getOffer()
    {
        $limit = 100;
        $offset = 0;
        $count = CardsTable::getList([
            'select' => [
                'id',
            ],
            'filter' => [
                '=wbId' => $this->wbId,
                '=OFFER.is_update' => 'Y',
            ],
        ])->getSelectedRowsCount();
        while (true) {
            $products = CardsTable::getList([
                'select' => [
                    '*',
                    'OFFER.is_update'
                ],
                'filter' => [
                    '=wbId' => $this->wbId,
                    '=OFFER.is_update' => 'Y'
                ],
                'offset' => $offset,
                'limit' => $limit
            ])->fetchAll();
            if ($offset > $count) break;
            $offset += $limit;
            foreach ($products as $product) {
                $offerObj = unserialize($product['data']);
                $offerObj = $this->convertOffer($offerObj);
                if ($this->filterOffers($offerObj)) {
                    yield $offerObj;
                }
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
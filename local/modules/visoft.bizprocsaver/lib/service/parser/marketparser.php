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
        $limit = 40;
        $offset = 0;
        while (true) {
            $products = CardsTable::getList([
                'select' => [
                    '*',
                ],
                'filter' => [
                    '=wbId' => $this->wbId
                ],
                'limit' => $limit,
                'offset' => $offset
            ])->fetchAll();
            if (empty($products)) break;
            $offset+=$limit;
            foreach ($products as $product) {
                $offerObj = unserialize($product['data']);
                $offerObj = $this->convertOffer($offerObj);
                if ($this->filterOffers($offerObj)) {
                    yield [$offerObj, $product['barcode'], $product['nmId']];
                }
            }
        }
    }

    /**
     *
     * @param $offerObj Offer\Offer
     * @return bool
     */
    protected function filterOffers($offerObj)
    {
        return true;
    }

    protected function convertOffer(Offer\Offer $offerObj)
    {
        return $offerObj;
    }
}
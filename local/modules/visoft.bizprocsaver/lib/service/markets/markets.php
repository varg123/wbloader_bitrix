<?php

namespace ViSoft\BizProcSaver\Service\Markets;

use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;
use ViSoft\BizProcSaver\Service\Joomla\ProductsTable;
use ViSoft\BizProcSaver\Service\Parser\JoomlaParser;
use ViSoft\BizProcSaver\Tables\OfferTable;

class Markets
{
    public function getMarkets(): array
    {
        return [
            new \ViSoft\BizProcSaver\Service\Markets\Market1(),//ООО Маркетплейс
//            new \ViSoft\BizProcSaver\Service\Markets\Market2(),//Качусов
        ];
    }

    public static function loadOffers()
    {
        $parser = new JoomlaParser();
        foreach ($parser->getOffer() as $offer) {
            OfferTable::saveOffer($offer);
        }
    }

    public static function loadOutlets()
    {
        $offset=0;
        $limit=10000;
        $count = ProductsTable::getList([
            'select' => [
                'product_id',
//                'product_quantity',
            ],
//            'limit' => 100
        ])->getSelectedRowsCount();
//        $count=5;
        while (true) {
            $products = ProductsTable::getList([
                'select' => [
                    'product_id',
                    'product_quantity',
                ],
                'limit' => $limit,
                'offset' => $offset
            ])->fetchAll();
            if ($offset >= $count) break;
            $offset += $limit;
            foreach($products as $product) {
                OfferTable::saveOutlet($product);
            }
        }
    }

    public static function resetUpdate()
    {
        global $DB;
        $DB->Query('update b_wb_offers set is_update="N"');
    }
}
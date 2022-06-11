<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric;

use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Test;

class CardFabric
{

    function createCard($offer)
    {
        $product = null;
        $product = new Test($offer);
//        switch ($offer->category) {
//            case 'будильники':
//            case 'метеостанции':
//                $product = new AlarmClock($offer);
//                break;
//            case 'настольные часы':
//            case 'напольные часы':
//                $product = new TableClock($offer);
//                break;
//            case 'Настенные часы':
//                $product = new WallClock($offer);
//                break;
//            case 'Мужские часы':
//            case 'Женские часы':
//            case 'Детские часы':
//            case 'Часы наклейки':
//            case 'Stailer':
//            case 'карманные часы':
//                $product = new WristWatches($offer);
//                break;
//            case 'ремешки':
//            case 'браслеты':
//                $product = new BraceletsWatches($offer);
//                break;
//            case 'статуэтки':
//                $product = new Figurines($offer);
//                break;
//            case 'Автопроставки':
//                $product = new AutoParts($offer);
//                break;
//            case 'Зажигалки':
//                $product = new Lighter($offer);
//                break;
//            default:
//                throw new \Exception("не описанная категория");
//        }
//        return $product ? $product->getProduct() : false;
        return $product->getProduct();
    }

    function updateCard($card, $offer)
    {

        $product = null;
        $product = new Test($offer);
        return $product;
//        $card->addin=[];
//        if ($card->nomenclatures) {
//            $card->nomenclatures[0]->addin =[];
//        }
//        if ($card->nomenclatures[0]->variations) {
//            $card->nomenclatures[0]->variations[0]->addin =[];
//        }
//
//        $product = null;
//        switch ($offer->category) {
//            case 'будильники':
//            case 'метеостанции':
//                $product = new AlarmClock($offer);
//                break;
//            case 'настольные часы':
//            case 'напольные часы':
//                $product = new TableClock($offer);
//                break;
//            case 'Настенные часы':
//                $product = new WallClock($offer);
//                break;
//            case 'Мужские часы':
//            case 'Женские часы':
//            case 'Детские часы':
//            case 'Часы наклейки':
//            case 'Stailer':
//            case 'карманные часы':
//                $product = new WristWatches($offer);
//                break;
//            case 'ремешки':
//            case 'браслеты':
//                $product = new BraceletsWatches($offer);
//                break;
//            case 'статуэтки':
//                $product = new Figurines($offer);
//                break;
//            case 'Автопроставки':
//                $product = new AutoParts($offer);
//                break;
//            case 'Зажигалки':
//                $product = new Lighter($offer);
//                break;
//            default:
//                throw new \Exception("не описанная категория");
//        }
//        return $product ? $product->getProduct($card) : false;
    }
}
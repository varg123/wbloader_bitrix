<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric;

use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Brasleti;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Broshi;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\SimpleProduct;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\SimpleProductWithSex;

class CardFabric
{

    function createCard($offer)
    {
        /**
         * @var $product BaseProduct
         */
        switch ($offer->category) {
            case 'Ободки':
                $product = new SimpleProduct($offer, 'Ободки');
                break;
            case 'Невидимки, зажимы и шпильки':
                $product = new SimpleProduct($offer, 'Невидимки');
                break;
            case 'Резинки':
                $product = new SimpleProductWithSex($offer, 'Резинки');
                break;
            case 'Крабы, бананы, заколки':
                $product = new SimpleProductWithSex($offer, 'Заколки клик-клак');
                break;
            case 'Аксессуары для создания прически':
            case 'Наборы аксессуаров для волос':
                $product = new SimpleProduct($offer, 'Наборы аксессуаров для волос');
                break;
//                todo: проверить по размерам Повязки
//            case 'Повязки':
            case 'Диадемы':
                $product = new SimpleProduct($offer, 'Диадемы');
                break;
            case 'Банты':
                $product = new SimpleProductWithSex($offer, 'Банты');
                break;
            case 'Гребни':
                $product = new SimpleProductWithSex($offer, 'Гребни');
                break;


//                todo: проверить по размерам Браслеты
            case 'Браслеты ассорти':
            case 'Деревянные браслеты':
            case 'Браслеты из бисера':
            case 'Кожаные браслеты':
            case 'Металлические браслеты':
            case 'Браслеты на ногу':
            case 'Браслеты на предплечье':
            case 'Новогодние браслеты':
            case 'Пластиковые браслеты':
            case 'Браслеты под натуральный камень':
            case 'Браслеты с жемчугом':
            case 'Браслеты с эмалью':
            case 'Браслеты со стразами':
            case 'Браслеты-кольца':
            case 'Браслеты-обереги':
            case 'Браслеты-пружинка':
            case 'Посеребренные и позолоченные браслеты':
                $product = new Brasleti($offer);
                break;


            case 'Броши':
            case 'Ассорти':
            case 'Металлические броши':
            case 'Броши под натуральный камень':
            case 'Посеребренные и позолоченные броши':
            case 'Броши с жемчугом':
            case 'Броши с эмалью':
            case 'Броши со стразами':
            case 'Текстильные броши':
            case 'Деревянные броши':
            case 'Акриловые броши':
            case 'Кожаные броши':
            case 'Аксессуары для платков':
            case 'Новогодние броши':
            case 'Зажимы для кардиганов':
                $product = new Broshi($offer);
                break;

//            case 'Значки':
            case 'Булавки':
                $product = new SimpleProduct($offer, 'Булавки');
                break;
            case 'Обереги':
                $product = new SimpleProduct($offer, 'Обереги');
                break;
            case 'Муфты':
                $product = new SimpleProductWithSex($offer, 'Муфты');
                break;
//            case 'Кольца':
            case 'Зажимы':
                $product = new SimpleProduct($offer, 'Зажимы');
                break;
            case 'Магниты':
                $product = new SimpleProduct($offer, 'Магниты');
                break;
            case 'Пряжки':
                $product = new SimpleProductWithSex($offer, 'Пряжки');
                break;


            default:
                throw new \Exception("Не описанная категория");
        }
        return $product->getProduct();
    }

    function updateCard($card, $offer)
    {

//        $product = null;
//        $product = new Test($offer);
//        return $product;
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
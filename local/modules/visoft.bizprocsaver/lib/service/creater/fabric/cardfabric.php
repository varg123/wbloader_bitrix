<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric;

use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Bishuteria;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\BishuteriaWithSize;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Brasleti;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\ProductWithSex;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\SimpleProduct;

class CardFabric
{

    function createCard($offer)
    {
        /**
         * @var $product BaseProduct
         */
        switch ($offer->category) {
            case 'Ободки' :
            case 'Невидимки, зажимы и шпильки' :
            case 'Наборы аксессуаров для волос' :
            case 'Аксессуары для создания прически' :
            case 'Банты' :
            case 'Гребни' :
            case 'Булавки' :
            case 'Обереги' :
            case 'Зажимы':
            case 'Магниты' :
            case 'Наборы, гарнитуры' :
            case 'Колье' :
            case 'Каффы' :
            case 'Детские наборы украшений' :
            case 'Запонки и зажимы' :
            case 'Кольца, перстни':
            case 'Наборы' :
            case 'Гарнитуры' :
            case 'Амулеты' :
            case 'Сучкорезы' :
            case 'Садовые ножи' :
            case 'Садовые ножовки' :
            case 'Столярный инструмент' :
            case 'Косы, серпы':
            case 'Ножницы, секаторы' :
            case 'Топоры, колуны':
            case 'Кусторезы' :
            case 'Тележки' :
            case 'Тачки':
            case 'Комплектующие для тачек' :
            case 'Ковши, черпаки':
            case 'Садовые щётки':
            case 'Канистры' :
            case 'Баки' :
            case 'Бочки' :
            case 'Фляги' :
            case 'Бидоны' :
            case 'Вёдра' :
            case 'Тазы':
            case 'Мётлы' :
            case 'Вилы':
            case 'Грабли':
            case 'Лопаты' :
            case 'Мотыги' :
            case 'Рыхлители' :
            case 'Плоскорезы' :
            case 'Черенки' :
            case 'Сеялки':
            case 'Посадочные вилки':
            case 'Корнеудалители':
            case 'Мотыжки' :
            case 'Наборы садовых инструментов':
            case 'Совки' :
            case 'Малые грабли' :
            case 'Малые рыхлители' :
                $product = new SimpleProduct($offer);
                break;
            case 'Резинки' :
            case 'Крабы, бананы, заколки' :
            case 'Повязки':
            case 'Диадемы' :
            case 'Муфты' :
            case 'Пряжки' :
                $product = new ProductWithSex($offer);
                break;
            case 'Браслеты' :
            case 'Браслеты ассорти' :
            case 'Деревянные браслеты' :
            case 'Браслеты из бисера' :
            case 'Кожаные браслеты':
            case 'Металлические браслеты' :
            case 'Браслеты на ногу' :
            case 'Браслеты на предплечье':
            case 'Новогодние браслеты' :
            case 'Пластиковые браслеты' :
            case 'Браслеты под натуральный камень' :
            case 'Браслеты с жемчугом' :
            case 'Браслеты с эмалью':
            case 'Браслеты со стразами' :
            case 'Браслеты-кольца':
            case 'Браслеты-обереги' :
            case 'Браслеты-пружинка' :
            case 'Посеребренные и позолоченные браслеты' :
            case 'Ассорти' :
            case 'Металлические броши' :
            case 'Броши под натуральный камень' :
            case 'Посеребренные и позолоченные броши' :
            case 'Броши с жемчугом' :
            case 'Броши с эмалью':
            case 'Броши со стразами' :
            case 'Броши' :
            case 'Текстильные броши' :
            case 'Деревянные броши' :
            case 'Акриловые броши' :
            case 'Кожаные броши':
            case 'Значки' :
            case 'Аксессуары для платков' :
            case 'Кольца' :
            case 'Новогодние броши' :
            case 'Зажимы для кардиганов' :
            case 'Кулоны':
            case 'Подвески' :
            case 'Серьги' :
            case 'Новогодние серьги':
            case 'Серьги в наборах':
            case 'Серьги ассорти':
            case 'Серьги висячие со стразами':
            case 'Деревянные серьги':
            case 'Серьги диорис' :
            case 'Серьги из камня':
            case 'Серьги из ракушки' :
            case 'Металлические серьги' :
            case 'Серьги перья':
            case 'Посеребренные и позолоченные серьги':
            case 'Серьги с жемчугом' :
            case 'Серьги с эмалью':
            case 'Серьги со стразами' :
            case 'Серьги-кисти' :
            case 'Серьги-кольца' :
            case 'Серьги-обереги' :
            case 'Пластиковые и акриловые серьги' :
            case 'Пластиковые серьги' :
            case 'Акриловые серьги' :
            case 'Детские браслеты' :
            case 'Чётки':
            case 'Клипсы' :
            case 'Детские клипсы' :
            case 'Детские кольца' :
            case 'Детские кулоны' :
            case 'Детские серьги' :
            case 'Детские комплекты' :
            case 'Детские броши' :
            case 'Цепи':
            case 'Декоративные цепи' :
            case 'Классические цепи':
            case 'Чокеры' :
                $product = new Bishuteria($offer);
                break;
            case 'Бусы' :
            case 'Бусины на нити' :
            case 'Детские бусы' :
                $product = new BishuteriaWithSize($offer);
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
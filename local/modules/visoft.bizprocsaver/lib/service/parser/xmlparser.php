<?php

namespace ViSoft\BizProcSaver\Service\Parser;

use ViSoft\BizProcSaver\Service\Creater\Offer;

class XmlParser implements Offer\IGetOffer
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getOffer()
    {
        $xlmData = file_get_contents($this->url);
        $xml = new \SimpleXMLElement($xlmData, LIBXML_COMPACT | LIBXML_PARSEHUGE);

        $categoriesXml = $xml->xpath('/yml_catalog/shop/categories/category');
        $categories = [];
        foreach ($categoriesXml as $categoty) {
            $categories[(string)$categoty->attributes()['id']] = (string)$categoty[0];
        }

        $offersXml = $xml->xpath('/yml_catalog/shop/offers/offer');
        foreach ($offersXml as $offerData) {
            $offer = [];
            $offer['id'] = (string)$offerData->attributes()['id'];
            //todo: артикул вынести желательно в какой-нибудь метод внедряемый из вне, будет описывать инструкции по изменению оффера, перед его выдачей
            $offer['price'] = (float)($offerData->price);
            $offer['currencyId'] = (string)($offerData->currencyId);
            $offer['category'] = $categories[(string)($offerData->categoryId)];
            //todo: проверить зачем так сделал
//            foreach ((array)$offerData->categoryId as $categoryId) {
//                $categoryId = (string)$categoryId;
//                if (in_array($categoryId, $categoryIds)) {
//                    $offer['categoryId'] = $categoryId;
//                    $offer['category'] = $result['categories'][$categoryId];
//                    break;
//                }
//            }
            $offer['name'] = (string)$offerData->name;
            $offer['weight'] = (float)$offerData->weight;
            $offer['delivery'] = $offerData->delivery == 'true' ? true : false;
            $offer['pickup'] = $offerData->pickup == 'true' ? true : false;
            $offer['store'] = $offerData->store == 'true' ? true : false;
            $offer['vendor'] = (string)$offerData->vendor;
            $offer['model'] = (string)$offerData->model;
            $offer['vendorCode'] = (int)$offerData->vendorCode;
            $offer['manufacturer_warranty'] = $offerData->manufacturer_warranty== 'true' ? true : false;
            $offer['description'] = (string)$offerData->description;
            $offer['url'] = $offerData->url;

            foreach ($offerData->xpath('param') as $param) {
                $offer['params'][(string)$param->attributes()['name']] = str_replace(' | ', ', ', (string)$param);
                switch ((string)$param->attributes()['name']) {
                    //todo: узнать что делать
//                    case 'Код товара':
//                        $offer['kod'] = (string)$param;
//                        $articul = preg_replace('/[^A-Za-z0-9А-Яа-я\-]/ui', '_', $offer['kod']);
//                        $offer['articul'] = $articul;
//                        break;
                    case 'Габариты (глубина × ширина × высота)':
                        $offer['dimensions'] = (string)$param;
                        break;
                    case 'Материал':
                        $offer['material'] = (string)$param;
                        break;
                }
            }
            $offerObj = new Offer\Offer($offer);
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
    protected function filterOffers($offerObj)
    {
        return true;
    }

    protected function convertOffer(Offer\Offer $offerObj)
    {
        return $offerObj;
    }
}
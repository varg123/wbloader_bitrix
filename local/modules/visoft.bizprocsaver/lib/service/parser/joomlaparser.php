<?php

namespace ViSoft\BizProcSaver\Service\Parser;

use ViSoft\BizProcSaver\Service\Creater\Offer;
use ViSoft\BizProcSaver\Service\Joomla\CategoriesTable;

class JoomlaParser implements Offer\IGetOffer
{

    public function __construct()
    {
    }

    public function getOffer()
    {
        $req = \ViSoft\BizProcSaver\Service\Joomla\ProductsTable::getList([
            'select' => [
                '*',
                'category_id' => 'CATEGORIES.category_id',
                'category_parent_id' => 'CATEGORIES.category_parent_id',
                'CATEGORIES.*',
                'category_name' => 'CATEGORIES.name_ru-RU',
            ],
            'limit' => 100
        ]);


        while ($product = $req->fetch()) {
                $offer = [];
                $offer['id'] = (int)$product['product_id'];
                $offer['price'] = (float)$product['product_price'];
                $offer['category'] = $product['category_name'];
                $offer['model'] = $product['name_ru-RU'];
                $offer['weight'] = (float)$product['product_weight'];
                //product_manufacturer_id
                $vendor = \ViSoft\BizProcSaver\Service\Joomla\ManufacturersTable::getList([
                    'select' => [
                        'name_ru-RU'
                    ],
                    'filter' => [
                        'manufacturer_id' => $product['product_manufacturer_id']
                    ]
                ])->fetch()['name_ru-RU'];
                $offer['vendor'] = $vendor;
                $offer['vendorCode'] = $product['product_ean'];
                $res = \ViSoft\BizProcSaver\Service\Joomla\ImagesTable::getList([
                    'select' => [
                        'image_name'
                    ],
                    'filter' => [
                        'product_id' => $product['product_id']
                    ]
                ])->fetchAll();

                $picturesNames = array_column($res, 'image_name');
                $tmpUrl = 'http://marketserver.site/components/com_jshopping/files/img_products/';
                foreach ($picturesNames as $picName) {
                    $offer['pictures'][] = $tmpUrl . $picName;
                }
                $offer['dimensions'] = $product['extra_field_1'];
                $material = \ViSoft\BizProcSaver\Service\Joomla\ExtraFieldValuesTable::getList([
                    'select' => [
                        'name_ru-RU'
                    ],
                    'filter' => [
                        'field_id' => 2
                    ]
                ])->fetch()['name_ru-RU'];
                $offer['material'] = $material;
                $offer['quantity'] = (int)$product['product_quantity'];
                $offer['product_ean'] = (string)$product['product_ean'];
                $offer['description'] = mb_substr(strip_tags((string)$product['description_ru-RU']), 0, 1000);

                if ($product['category_parent_id']) {
                    $offer['parentCategory'] = CategoriesTable::getList([
                        'select' => [
                            '*'
                        ],
                        'filter' => [
                            '=category_id' => $product['category_parent_id'],
                        ]
                    ])->fetch()['name_ru-RU'];
                }

                $desc = strip_tags((string)$product['description_ru-RU']);
                $desc = preg_replace('/[^а-яА-ЯёЁ0-9a-zA-Z @!?,.|\/:;\'"*&\@#$№%\[\]\{\}\(\)\+\-\$]+/u', '', $desc);
                $offer['description'] = mb_substr($desc, 0, 1000);

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
<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product;

use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base\AddinField;
use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;

class ProductWithSex extends SimpleProduct
{
    public function getFields()
    {
        /**
         * @var Offer $offer
         */
        $offer = $this->offer;
        $sexValue = 'Женский';
        switch ($offer->parentCategory) {
            case 'Браслеты':
            case 'Аксессуары для волос':
            case 'Броши и значки':
            case 'Украшения, стилизованные под натуральный камень':
                $sexValue = 'Женский';
                break;
            case 'Детская бижутерия':
                $sexValue = 'Девочки';
                break;
            case 'Мужская бижутерия':
                $sexValue = 'Мужской';
                break;
        }

        $fields = parent::getFields();
        $fields[] = new AddinField("Пол", $sexValue);
        return $fields;
    }
}
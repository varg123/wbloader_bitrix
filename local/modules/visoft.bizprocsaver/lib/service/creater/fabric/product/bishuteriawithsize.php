<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product;

use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base\AddinField;
use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;

class BishuteriaWithSize extends Bishuteria
{
    public function getFields()
    {
        /**
         * @var Offer $offer
         */
        $fields = parent::getFields();
//        $fields[] = new AddinField("Состав бижутерии", 'в описании');
        return $fields;
    }
}
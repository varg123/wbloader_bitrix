<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base;

use ViSoft\BizProcSaver\Service\Creater\Fabric\IField;

class CountryField implements IField
{

    protected $value = null;

    public function __construct($vendor = null)
    {
        $this->value = $vendor;
    }

    /**
     * @param $card Card
     * @return Card
     */
    function applyField($card)
    {
//        $value = $this->value;
        $card->countryProduction = $this->value;
//        if ($this->countries[$value]) {
//            $card->countryProduction = $this->countries[$value];
//        }
        return $card;
    }

}
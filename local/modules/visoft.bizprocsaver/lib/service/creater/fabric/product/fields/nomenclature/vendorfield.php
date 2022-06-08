<?php


namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Nomenclature;


use ViSoft\BizProcSaver\Service\Creater\Fabric\IField;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Addin;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Nomenclature;

class VendorField implements IField
{

    protected $value = null;


    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @param $nomenclature Nomenclature
     * @return Nomenclature
     */
    function applyField($nomenclature)
    {
        $nomenclature->vendorCode = $this->value;
        return $nomenclature;
    }
}
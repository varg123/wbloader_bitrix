<?php


namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Nomenclature;


use ViSoft\BizProcSaver\Service\Creater\Fabric\IField;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Addin;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Nomenclature;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Variation;

class VariationField implements IField
{

    protected $barcode = null;
    protected $price = null;


    public function __construct($barcode, $price)
    {
        $this->barcode = $barcode;
        $this->price = $price;
    }

    /**
     * @param $nomenclature Nomenclature
     * @return Nomenclature
     */
    function applyField($nomenclature)
    {
        $variation = new Variation([
            'barcode' => $this->barcode
        ]);
        $variation->addin[] = new Addin([
            'type' => 'Розничная цена',
            'params' => [
                [
                    'count' => (int)$this->price
                ]
            ]
        ]);
        $nomenclature->variations = [$variation];
        return $nomenclature;
    }
}
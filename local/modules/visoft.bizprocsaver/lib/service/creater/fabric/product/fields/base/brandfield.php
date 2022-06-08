<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base;


use ViSoft\BizProcSaver\Service\Creater\Fabric\IField;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Addin;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;

class BrandField implements IField
{

    protected $value = null;

    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @param $card Card
     * @return Card
     */
    function applyField($card)
    {
        $value = $this->value;
        $card->addin[] = new Addin([
            'type' => 'Бренд',
            'params' => [
                [
                    'value' => $value
                ]
            ]
        ]);
        return $card;
    }

}
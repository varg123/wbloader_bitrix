<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base;



use ViSoft\BizProcSaver\Service\Creater\Fabric\IField;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;

class ObjectField implements IField
{

    protected $value = null;
    public function __construct($value=null)
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
        $card->object = $value;
        return $card;
    }
}
<?php


namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base;


use ViSoft\BizProcSaver\Service\Creater\Fabric\IField;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Addin;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;

class AddinField implements IField
{

    protected $value = null;
    protected $type = null;
    protected $count = null;

    public function __construct($type = null, $value = null, $count = null)
    {
        $this->value = $value;
        $this->type = $type;
        $this->count = $count;
    }

    /**
     * @param $card Card
     * @return Card
     */
    function applyField($card)
    {
        $value = $this->value;
        $type = $this->type;
        $count = $this->count;
        $card->addin[] = new Addin([
            'type' => $type,
            'params' => [
                [
                    'count' => $count,
                    'value' => $value
                ]
            ]
        ]);
        return $card;
    }
}
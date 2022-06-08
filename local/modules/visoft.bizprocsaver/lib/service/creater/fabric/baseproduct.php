<?php


namespace ViSoft\BizProcSaver\Service\Creater\Fabric;

use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;

abstract class BaseProduct implements IProduct
{
    protected $fields = [];
    function getFields()
    {
        return $this->fields;
    }

    function getProduct($card = null)
    {
        if (!$card) {
            $card = new Card();
        }
        foreach ($this->getFields() as $field) {
            $card  = $field->applyField($card);
        }
        return $card;
    }
}
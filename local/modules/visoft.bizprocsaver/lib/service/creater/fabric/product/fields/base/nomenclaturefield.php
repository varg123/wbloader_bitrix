<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base;


use ViSoft\BizProcSaver\Service\Creater\Fabric\IField;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Addin;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Nomenclature;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Parameter;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Variation;

class NomenclatureField implements IField
{

    protected $fields = [];

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param $card Card
     * @return Card
     */
    function applyField($card)
    {
        /**
         * @var IField $field
         */
        if ($card->nomenclatures) {
            $nomenclature = $card->nomenclatures[0];
        }
        else {
            $nomenclature = new Nomenclature();
        }
        foreach ($this->fields as $field) {
            $nomenclature = $field->applyField($nomenclature);
        }
        $card->nomenclatures = [$nomenclature];
        return $card;
    }

}
<?php


namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Nomenclature;


use ViSoft\BizProcSaver\Service\Creater\Fabric\IField;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Addin;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Card;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Nomenclature;
use ViSoft\BizProcSaver\Service\WBApi\Dto\Parameter;

class PhotoField implements IField
{

    protected $photos = null;


    public function __construct($photos = null)
    {
        $this->photos = $photos;
    }

    /**
     * @param $nomenclature Nomenclature
     * @return Nomenclature
     */
    function applyField($nomenclature)
    {
        /**
         * @var Addin $addin
         */
        foreach ($nomenclature->addin as $key => $addin) {
            if (in_array($addin->type, ['Фото', 'Фото360', 'Видео']))
                unset($nomenclature->addin[$key]);
        }
        $addinPhoto = new Addin([
            'type' => 'Фото'
        ]);
        foreach ($this->photos as $photo) {
            $addinPhoto->params[] = new Parameter([
                'value' => $photo
            ]);
        }
        $nomenclature->addin[] = $addinPhoto;
        $nomenclature->addin[] = new Addin([
            'type' => 'Фото360',
        ]);
        $nomenclature->addin[] = new Addin([
            'type' => 'Видео',
        ]);
        return $nomenclature;
    }
}
<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product;


use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base\AddinField;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base\BrandField;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base\CountryField;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base\NomenclatureField;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base\ObjectField;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Base\SupplierVendorCodeField;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Nomenclature\PhotoField;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Nomenclature\VariationField;
use ViSoft\BizProcSaver\Service\Creater\Fabric\Product\Fields\Nomenclature\VendorField;
use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;

class Test extends \ViSoft\BizProcSaver\Service\Creater\Fabric\BaseProduct
{
    protected $offer = null;

    public function __construct($offer)
    {
        $this->offer = $offer;
    }
    public function getFields()
    {
        /**
         * @var Offer $offer
         */
        $offer = $this->offer;
        $fields = [
            new ObjectField("БАДы"),
            new CountryField("Китай"),
            new BrandField("Tarasoff"),
            new AddinField("Комплектация", 'упаковка, товар'),
            new AddinField("Наименование", $offer->model),
            new SupplierVendorCodeField('testt'.$offer->id)
            //упаковка, товар
        ];

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhY2Nlc3NJRCI6IjllM2I4NWVkLTQwN2QtNDdmNC1hYWM0LThmYzU0ZWJjZDNiNiJ9.ap7rjYDyGfCbnz0UIaWmJQxdstIDPFNHaRS8zu3W44Q';
        $query = new \ViSoft\BizProcSaver\Service\WBApi\WBQuery($token);
        $fields[] = new NomenclatureField([
            new VendorField('test'.$offer->id),
            new PhotoField($offer->pictures),
            new VariationField($query->getBarcodes()[0], '50'),
        ]);


        return $fields;
    }
}
<?php

namespace ViSoft\BizProcSaver\Service\Creater\Fabric\Product;


use ViSoft\BizProcSaver\Service\Creater\Fabric\BaseProduct;
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

class Broshi extends BaseProduct
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
            new ObjectField('Браслеты'),
            new CountryField("Китай"),
            new BrandField("Tarasoff"),
            new AddinField("Комплектация", 'упаковка, товар'),
            new AddinField("Наименование", $offer->model),
            new AddinField("Пол", 'Женский'),
            new SupplierVendorCodeField('ttttt' . $offer->id)
        ];

        $fields[] = new NomenclatureField([
            new VendorField('tttttt' . $offer->id),
            new PhotoField(['https://avatars.mds.yandex.net/get-zen_doc/1852570/pub_6117bfcf77c7ad7281be77ff_6117bfd35be0d94cdffb8815/scale_1200']),
            new VariationField($offer->barcode, (int)$offer->price),
        ]);
        return $fields;
    }
}
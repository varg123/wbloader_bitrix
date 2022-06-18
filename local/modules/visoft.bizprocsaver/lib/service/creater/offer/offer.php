<?php


namespace ViSoft\BizProcSaver\Service\Creater\Offer;

use Spatie\DataTransferObject\DataTransferObject;

class Offer extends DataTransferObject
{
    public $id;
    public $price;
    public $product_ean;
    public $category;
    public $parentCategory = null;
    public $weight;
    public $quantity;
    public $vendor;
    public $model;
    public $pictures;
    public $description;
    public $barcode = null;

    public $vendorCode = null;
    public $vendorCodeSupplier = null;


    //params
    public $dimensions;
    public $material;

}


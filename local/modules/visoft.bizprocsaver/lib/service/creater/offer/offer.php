<?php


namespace ViSoft\BizProcSaver\Service\Creater\Offer;
use Spatie\DataTransferObject\DataTransferObject;

class Offer extends DataTransferObject
{
    public $id;
    public $articul2;
    public $price;
    public $currencyId;
    public $category;
    public $name;
    public $weight;
    public $delivery;
    public $pickup;
    public $store;
    public $vendor;
    public $model;
    public $vendorCode;
    public $manufacturer_warranty;
    public $description;
    public $url;

    public $params;


    //params
    public $dimensions;
    public $material;

}


<?php


namespace ViSoft\BizProcSaver\Service\Creater\Offer;
use Spatie\DataTransferObject\DataTransferObject;

class Offer extends DataTransferObject
{
    public $id;
    public $price;
    public $category;
    public $weight;
    public $quantity;
    public $vendor;
    public $model;
    public $vendorCode;
    public $pictures;


    //params
    public $dimensions;
    public $material;

}


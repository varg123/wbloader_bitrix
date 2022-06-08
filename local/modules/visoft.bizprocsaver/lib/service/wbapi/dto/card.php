<?php



namespace ViSoft\BizProcSaver\Service\WBApi\Dto;


use Spatie\DataTransferObject\DataTransferObject;

use Spatie\DataTransferObject\Attributes\CastWith;
class Card extends  DataTransferObject
{

    #[CastWith(AddinArrayCaster::class)]
    public  $addin;

    public  $countryProduction;
    public  $createdAt;
    public  $id;
    public  $imtId;
    public  $imtSupplierId;

    #[CastWith(NomenclatureArrayCaster::class)]
    public  $nomenclatures;

    public $object;
    public $parent;
    public $supplierId;
    public $supplierVendorCode;
    public $updatedAt;
    public $uploadID;
    public $userId;

    public $batchID;


}
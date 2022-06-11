<?php



namespace ViSoft\BizProcSaver\Service\WBApi\Dto;


use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class Nomenclature  extends DataTransferObject
{
    #[CastWith(AddinArrayCaster::class)]
    public  $addin;
    public  $concatVendorCode;
    public  $id;
    public  $isArchive;
    public  $nmId;
    #[CastWith(VariationArrayCaster::class)]
    public  $variations;
    public  $vendorCode;
}
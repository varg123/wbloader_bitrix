<?php



namespace ViSoft\BizProcSaver\Service\WBApi\Dto;


use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class Variation extends DataTransferObject
{
    #[CastWith(AddinArrayCaster::class)]
    public $addin;
    public $barcode;
    public $barcodes;
    public $chrtId;
    public $errors;
    public $id;
}
<?php


namespace ViSoft\BizProcSaver\Service\WBApi\Dto;


use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;

class Addin extends DataTransferObject
{
    #[CastWith(ParameterArrayCaster::class)]
    public $params;
    public $type;
}

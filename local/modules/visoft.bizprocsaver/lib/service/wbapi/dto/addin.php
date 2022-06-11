<?php


namespace ViSoft\BizProcSaver\Service\WBApi\Dto;


use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;

class Addin extends DataTransferObject
{
    /** @var Parameter[] */
    public $params;
    public $type;
}

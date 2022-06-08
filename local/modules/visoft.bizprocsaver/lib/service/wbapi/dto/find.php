<?php



namespace ViSoft\BizProcSaver\Service\WBApi\Dto;


use Spatie\DataTransferObject\DataTransferObject;
//use \Spatie\DataTransferObject\;


use Spatie\DataTransferObject\Attributes\CastWith;
class Find extends DataTransferObject
{
    public $column;
    public $search;
}

<?php


namespace ViSoft\BizProcSaver\Service\WBApi\Dto;


use Spatie\DataTransferObject\DataTransferObject;
//use \Spatie\DataTransferObject\;


use Spatie\DataTransferObject\Attributes\CastWith;
class Filter extends DataTransferObject
{
    public $column;
    public $excludedValues;
}

<?php


namespace ViSoft\BizProcSaver\Service\WBApi\Dto;


use Spatie\DataTransferObject\Caster;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
class AddinArrayCaster implements Caster
{
    #[CastWith(ParameterArrayCaster::class)]
    public array $params;
    public $type;

    public function cast(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \Exception("Can only cast arrays to Foo");
        }

        return array_map(
            fn (array $data) => new Addin(...$data),
            $value
        );
    }
}

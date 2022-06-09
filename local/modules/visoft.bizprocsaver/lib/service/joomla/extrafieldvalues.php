<?php


namespace ViSoft\BizProcSaver\Service\Joomla;


use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\BooleanField,
    Bitrix\Main\ORM\Fields\DatetimeField,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\TextField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

Loc::loadMessages(__FILE__);


class ExtraFieldValuesTable extends DataManager
{
    public static function getConnectionName()
    {
        return 'joomla';
    }

    public static function getTableName()
    {
        return 'mrkt_jshopping_products_extra_field_values';
    }

    public static function getMap()
    {
        return [
            'id' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => 'test',
            ],
            'field_id' => [
                'data_type' => 'integer',
            ],
            'name_ru-RU' => [
                'data_type' => 'integer',
            ],
        ];
    }

}
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


class CategoriesTable extends DataManager
{
    public static function getConnectionName()
    {
        return 'joomla';
    }

    public static function getTableName()
    {
        return 'mrkt_jshopping_categories';
    }

    public static function getMap()
    {
        return [
            'category_id' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => 'test',
            ],
            'category_parent_id' => [
                'data_type' => 'integer',
            ],
            'name_ru-RU' => [
                'data_type' => 'string',
            ],
        ];
    }

}
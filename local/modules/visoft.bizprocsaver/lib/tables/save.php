<?php


namespace ViSoft\BizProcSaver\Tables;


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


class SaveTable extends DataManager
{
    public static function getConnectionName()
    {
        return VISOFT_CONNECTION_NAME;
    }

    public static function getTableName()
    {
        return 'b_visoft_bizprocsaver_save';
    }

    public static function getMap()
    {
        return [
            new IntegerField(
                'ID',
                [
                    'primary' => true,
                    'autocomplete' => true,
                ]
            ),
            new StringField(
                'SAVE_NAME',
                [
                    'size' => 256
                ]
            ),
            new DatetimeField(
                'SAVE_DATE',
                [
                    'required' => true,
                ]
            ),
            new IntegerField(
                'PARENT_ID',
                [
                ]
            ),
            new IntegerField(
                'TEMPLATE_ID',
                [
                ]
            ),
            new IntegerField(
                'SETTING_ID',
                [
                ]
            ),
        ];
    }

}
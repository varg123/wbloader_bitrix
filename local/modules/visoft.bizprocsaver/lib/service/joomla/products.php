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
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

Loc::loadMessages(__FILE__);


class ProductsTable extends DataManager
{
    public static function getConnectionName()
    {
        return 'joomla';
    }

    public static function getTableName()
    {
        return 'mrkt_jshopping_products';
    }

    public static function getMap()
    {
        return [
            'product_id' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => 'test',
            ],
            'product_ean' => [
                'data_type' => 'string',
            ],
            'product_quantity' => [
                'data_type' => 'float',
            ],
            'product_date_added' => [
                'data_type' => 'datetime',
            ],
            'date_modify' => [
                'data_type' => 'datetime',
            ],
            'product_price' => [
                'data_type' => 'float',
            ],
            'product_weight' => [
                'data_type' => 'float',
            ],
            'image' => [
                'data_type' => 'string',
            ],
            'product_manufacturer_id' => [
                'data_type' => 'integer',
            ],
            'name_ru-RU' => [
                'data_type' => 'string',
            ],
            'alias_ru-RU' => [
                'data_type' => 'string',
            ],
            'extra_field_1' => [
                'data_type' => 'string',
            ],
            'extra_field_2' => [
                'data_type' => 'string',
            ],
            'extra_field_3' => [
                'data_type' => 'string',
            ],
            'extra_field_4' => [
                'data_type' => 'string',
            ],
            'extra_field_5' => [
                'data_type' => 'string',
            ],
            'extra_field_6' => [
                'data_type' => 'string',
            ],
            (new ManyToMany('CATEGORIES', CategoriesTable::class))
                ->configureTableName(ProductsToCategoriesTable::getTableName())
                ->configureLocalPrimary('product_id', 'product_id')
                ->configureLocalReference('my_product')
                ->configureRemotePrimary('category_id', 'category_id')
                ->configureRemoteReference('my_category')
        ];
    }

}
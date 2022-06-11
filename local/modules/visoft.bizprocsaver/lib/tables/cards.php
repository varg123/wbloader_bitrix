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


class CardsTable extends DataManager
{

    public static function getTableName()
    {
        return 'b_wb_cards';
    }

    public static function getMap()
    {
        return [
            'id' => [
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
            ],
            'wbId' => [
                'data_type' => 'string',
            ],
            'barcode' => [
                'data_type' => 'string',
            ],
            'nmId' => [
                'data_type' => 'integer',
            ],
            'vendorCode' => [
                'data_type' => 'string',
            ],
            'price' => [
                'data_type' => 'float',
            ],
            'outlet' => [
                'data_type' => 'integer',
            ],
            'offer_id' => [
                'data_type' => 'integer',
            ],
            'data' => [
                'data_type' => 'text',
            ],
            'error' => [
                'data_type' => 'text',
            ],
            (new Reference(
                'OFFER',
                OfferTable::class,
                Join::on('this.offer_id', 'ref.id')
            ))
                ->configureJoinType('inner')
        ];
    }

    static function getIds($wbId, $offerId)
    {
        $row = self::getList([
            'select' => [
                'id',
                'nmId',
                'barcode',
                'vendorCode'
            ],
            'filter' => [
                '=wbId' => $wbId,
                '=offer_id' => $offerId
            ]
        ])->fetch();
        if ($row) return [$row['barcode'],$row['vendorCode'],$row['nmId']];
        return ['', '', ''];
    }

    static function setError($wbId, $offerId, $error)
    {
        $row = self::getList([
            'select' => [
                'id',
                'wbId',
                'offer_id'
            ],
            'filter' => [
                '=wbId' => $wbId,
                '=offer_id' => $offerId
            ]
        ])->fetch();
        if ($row) {
            self::update($row['id'], [
                'error' => $error
            ]);
        }
    }

    static function setIds($wbId, $offerId, $nmId, $barcode, $vendorCode)
    {
        $row = self::getList([
            'select' => [
                'id',
                'wbId',
                'offer_id'
            ],
            'filter' => [
                '=wbId' => $wbId,
                '=offer_id' => $offerId
            ]
        ])->fetch();
        if ($row) {
            self::update($row['id'], [
                'nmId' => $nmId,
                'barcode' => $barcode?$barcode:'',
                'vendorCode' => $vendorCode,
                'error' => '',
            ]);
        }
    }
}
<?php


namespace ViSoft\BizProcSaver\Tables;


use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager;
use ViSoft\BizProcSaver\Service\Creater\Offer\Offer;

Loc::loadMessages(__FILE__);


class OfferTable extends DataManager
{

    public static function getTableName()
    {
        return 'b_wb_offers';
    }

    public static function getMap()
    {
        return [
            'id' => [
                'data_type' => 'integer',
                'primary' => true,
                'title' => 'test',
            ],
            'data' => [
                'data_type' => 'text',
            ],
            'price' => [
                'data_type' => 'float',
            ],
            'outlet' => [
                'data_type' => 'integer',
            ],
            'crc' => [
                'data_type' => 'string',
            ],
            'is_update' => [
                'data_type' => 'boolean',
                'values' => array('N', 'Y'),
                'default' => 'N'
            ],
        ];
    }

    /**
     * @param $offer Offer
     */
    public static function saveOffer($offer)
    {
        $crc = self::calculateCrc($offer);
        $offerRowData = self::getById($offer->id)->fetch();
        if ($offerRowData) {
            $params = [
                'data' => serialize($offer),
                'crc' => $crc,
                'price' => $offer->price,
                'outlet' => $offer->quantity,
            ];
            if($offerRowData['crc'] != $crc) {
                $params['is_update'] = 'Y';
            }
            self::update($offer->id, $params);
        }
        else {
            self::add([
                'id' => $offer->id,
                'data' => serialize($offer),
                'crc' => $crc,
                'is_update' => 'Y',
                'price' => $offer->price,
                'outlet' => $offer->quantity,
            ]);
        }
    }

    /**
     * @param $offer Offer
     */
    public static function calculateCrc($offer)
    {
        $offer = clone $offer;
        $offer->price = 0;
        $offer->quantity = 0;
        return crc32(serialize($offer));
    }
}
<?php

namespace ViSoft\BizProcSaver\Events;


use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\ORM\Event;
use ViSoft\BizProcSaver\Service\Markets\IMarket;
use ViSoft\BizProcSaver\Service\Markets\Markets;
use ViSoft\BizProcSaver\Tables\CardsTable;
use ViSoft\BizProcSaver\Tables\OfferTable;
use ViSoft\BizProcSaver\Tools\Events\IEvent;

class CreateCardsForLoad implements IEvent
{
    public function getMap()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $cardsTableName = OfferTable::getEntity()->getName();
        return [
            ['visoft.bizprocsaver', '\ViSoft\BizProcSaver\Tables\Offer::'.DataManager::EVENT_ON_AFTER_UPDATE, 'updateCards', '10'],
            ['visoft.bizprocsaver', '\ViSoft\BizProcSaver\Tables\Offer::'.DataManager::EVENT_ON_AFTER_ADD, 'updateCards', '10']
        ];
    }

    public static function test()
    {
        exit("asd");
    }

    /**
     * @param $event Event
     */
    public static function updateCards($p1, $p2, $fields)
    {
        if ($fields['outlet']) {
            $markets = new Markets();
            /**
             * @var $market IMarket
             */
            foreach ($markets->getMarkets() as $market) {
                $marketId = $market->getId();
                $cardRow = CardsTable::getList([
                    'select' => [
                        '*'
                    ],
                    'filter' => [
                        '=wbId' => $marketId,
                        '=offer_id' => $p2['id'],
                    ]
                ])->fetch();
                if ($cardRow) {
                    CardsTable::update($cardRow['id'],[
                        'outlet' => $fields['outlet'],
                    ]);
                }
            }
        }

        if ($fields['data']) {
            $offer = unserialize($fields['data']);
            $markets = new Markets();
            /**
             * @var $market IMarket
             */
            foreach ($markets->getMarkets() as $market) {
                $tmpOffer = clone $offer;
                $tmpOffer = $market->changeOffer($tmpOffer);
                $marketId = $market->getId();
                $cardRow = CardsTable::getList([
                    'select' => [
                        '*'
                    ],
                    'filter' => [
                        '=wbId' => $marketId,
                        '=offer_id' => $p2['id'],
                    ]
                ])->fetch();
                if ($cardRow) {
                    CardsTable::update($cardRow['id'],[
                        'wbId' => $marketId,
                        'price' => $tmpOffer->price,
                        'outlet' => $tmpOffer->quantity,
                        'offer_id' => $p2['id'],
                        'data' => serialize($tmpOffer),
                    ]);
                }
                else {
                    CardsTable::add([
                        'wbId' => $marketId,
                        'price' => $tmpOffer->price,
                        'outlet' => $tmpOffer->quantity,
                        'offer_id' => $p2['id'],
                        'data' => serialize($tmpOffer),
                    ]);
                }
            }
        }

    }
}
<?php

namespace ViSoft\BizProcSaver\Tools\Events;

class Events
{
    protected function getEvents()
    {
        return [];
    }

    private function addeventhandlers(IEvent $event)
    {
        $map = $event->getMap();
        foreach ($map as $itemMap) {
            AddEventHandler($itemMap[0], $itemMap[1], Array(get_class($event), $itemMap[2]), $itemMap[3]);
        }
    }

    public function register()
    {
        foreach ($this->getEvents() as $event) {
            $this->addeventhandlers($event);
        }
    }


}
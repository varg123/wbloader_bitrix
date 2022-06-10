<?php

namespace ViSoft\BizProcSaver;


use ViSoft\BizProcSaver\Events\CreateCardsForLoad;

class Events extends \ViSoft\BizProcSaver\Tools\Events\Events
{
    protected function getEvents()
    {
        return [
            new CreateCardsForLoad(),
        ];
    }
}
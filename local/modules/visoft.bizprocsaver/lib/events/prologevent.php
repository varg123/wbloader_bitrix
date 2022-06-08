<?php

namespace ViSoft\BizProcSaver\Events;


use ViSoft\BizProcSaver\Tools\Events\IEvent;

class PrologEvent implements IEvent
{
    public function getMap()
    {
        return [
            ['main', 'OnProlog', 'addButtons', '10']
        ];
    }

    public static function addButtons()
    {
//        exit("asd");
    }
}
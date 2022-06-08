<?php

namespace ViSoft\BizProcSaver;

use ViSoft\BizProcSaver\Events\PrologEvent;

class Events extends \ViSoft\BizProcSaver\Tools\Events\Events
{
    protected function getEvents()
    {
        return [
//            new PrologEvent(),
        ];
    }
}
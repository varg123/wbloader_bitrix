<?php

namespace ViSoft\BizProcSaver\Controllers;

use Bitrix\Main\Engine\Controller;

class Updater extends Controller
{
    public function configureActions()
    {
        return [
            'apply' => [
                'prefilters' => []
            ]
        ];
    }

    public function changeDefaultGroupAction()
    {
        $request = $this->getRequest()->getPostList();
        $newName = 'test';
        return ['response' => 'success', 'newName' => $newName];
    }


}
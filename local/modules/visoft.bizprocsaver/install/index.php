<?php

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

Class visoft_bizprocsaver extends CModule
{
    public $MODULE_ID = "visoft.bizprocsaver";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;


    public function __construct()
    {

        $this->MODULE_NAME = Loc::getMessage('VISOFT_BISZPROCSAVER_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('VISOFT_BISZPROCSAVER_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('VISOFT_BISZPROCSAVER_PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('VISOFT_BISZPROCSAVER_PARTNER_URI');

        $arModuleVersion = [];
        include __DIR__."/version.php";
        if ($arModuleVersion) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

    }

    function DoInstall()
    {
        RegisterModule($this->MODULE_ID);
    }

    function DoUninstall()
    {
        UnRegisterModule($this->MODULE_ID);
    }

}
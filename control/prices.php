<?php

use ViSoft\BizProcSaver\Service\Markets\Markets;

define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('CHK_EVENT', true);
define('BX_NO_ACCELERATOR_RESET', true);
define('PHP_SCRIPT', true);

set_time_limit(0);

$_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
global $USER;
$USER->Authorize(1);

$markets = new Markets();
try {
    $markets::loadPrices();
}
catch (\Exception $e) {
    \CEventLog::Add([
        "SEVERITY" => "SECURITY",
        "AUDIT_TYPE_ID" => "WB_ERROR",
        "MODULE_ID" => "main",
        "ITEM_ID" => 'loadPrices',
        "DESCRIPTION" => $e->getMessage(),
    ]);
}
/**
 * @var $market \ViSoft\BizProcSaver\Service\Markets\Market
 */
foreach ($markets->getMarkets() as $market) {
    try {
        $market->loadPrices();
    }
    catch (\Exception $e) {
        \CEventLog::Add([
            "SEVERITY" => "SECURITY",
            "AUDIT_TYPE_ID" => "WB_ERROR",
            "MODULE_ID" => "main",
            "ITEM_ID" => $market->getId(),
            "DESCRIPTION" => $e->getMessage(),
        ]);
    }
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
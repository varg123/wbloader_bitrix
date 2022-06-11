<?php
function file_log($arr, $name='log'){
    $log = date('Y-m-d H:i:s') . ' ' . print_r($arr, true);
    file_put_contents($_SERVER['DOCUMENT_ROOT']. '/logs/'.$name.'.txt', $log . PHP_EOL, FILE_APPEND);
}
function pre($arr){
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
}
ini_set( 'xdebug.var_display_max_depth', '10' );
ini_set( 'xdebug.var_display_max_children', '256' );
ini_set( 'xdebug.var_display_max_data', '2024' );

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
\Bitrix\Main\Loader::includeModule('visoft.bizprocsaver');
(new \ViSoft\BizProcSaver\Events())->register();
<?php
    define('PARSE_SDK_DIR','Parse/');
    require_once('autoload.php');
    use Parse\ParseClient;

    // Needs to be after includes but before init
    session_start();

    require_once('secrets.php');
    ParseClient::initialize($parseAppId, $parseRestKey, $parseMasterKey);
?>

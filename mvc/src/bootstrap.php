<?php
require_once 'settings.php';
require_once __DIR__ . '\..\src\vendor\autoload.php';
require_once __DIR__ . '\..\src\mainAutoload.php';

if (DEVELOPMENT === 1) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$app = new Base\Application();
$app->run();

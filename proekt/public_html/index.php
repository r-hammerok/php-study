<?php

include __DIR__ . "\..\src\models\User.php";
include __DIR__ . "\..\src\controllers\BaseController.php";
include __DIR__ . "\..\src\controllers\FrontController.php";
include __DIR__ . "\..\src\controllers\AdminController.php";

if (strpos($_SERVER['REQUEST_URI'],'/admin/register') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->register();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'],'/admin') !== false) {
    $controller = new \App\Controllers\AdminController();
    $controller->index();
    return 0;
}

$controller = new \App\Controllers\FrontController();
$controller->index();
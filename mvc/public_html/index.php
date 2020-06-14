<?php
include __DIR__ . '\..\src\controllers\BaseController.php';
include __DIR__ . '\..\src\controllers\UserController.php';
include __DIR__ . '\..\src\controllers\FrontController.php';
include __DIR__ . '\..\src\controllers\PostControllers.php';
include __DIR__ . '\..\src\controllers\Err404Controller.php';
include __DIR__ . '\..\src\models\user.php';
include __DIR__ . '\..\src\models\post.php';
include __DIR__ . '\..\src\base\db.php';
include __DIR__ . '\..\src\base\Session.php';

session_start();


if (strpos($_SERVER['REQUEST_URI'],'/user/login') !== false) {
    $controller = new \App\Controllers\UserController();
    $controller->showLoginForm();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'],'/user/register') !== false) {
    $controller = new \App\Controllers\UserController();
    $controller->showRegisterForm();
    return 0;
}

if ($_SERVER['REQUEST_URI'] === '/' || strpos($_SERVER['REQUEST_URI'],'/index/') !== false) {
    $controller = new \App\Controllers\FrontController();
    $controller->index();
    return 0;
}

//if (strpos($_SERVER['REQUEST_URI'],'/post/') !== false) {
//    $controller = new \App\Controllers\PostController();
//    $controller->index();
//    return 0;
//}
$controller = new \App\Controllers\Err404Controller();
$controller->index();

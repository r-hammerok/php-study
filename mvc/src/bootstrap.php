<?php
include __DIR__ . '\..\src\controllers\BaseController.php';
include __DIR__ . '\..\src\controllers\UserController.php';
include __DIR__ . '\..\src\controllers\FrontController.php';
include __DIR__ . '\..\src\controllers\PostController.php';
include __DIR__ . '\..\src\controllers\APIController.php';
include __DIR__ . '\..\src\controllers\Err404Controller.php';
include __DIR__ . '\..\src\models\User.php';
include __DIR__ . '\..\src\models\Post.php';
include __DIR__ . '\..\src\base\DB.php';
include __DIR__ . '\..\src\base\Settings.php';
include __DIR__ . '\..\src\base\Session.php';
include __DIR__ . '\..\src\base\Application.php';

if (DEVELOPMENT === 1) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

$app = new Base\Application();
$app->run();

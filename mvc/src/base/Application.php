<?php
namespace Base;

use App\Controllers as Controller;

class Application
{
    protected $session;

    public function run()
    {
        session_start();
        $this->session = Session::getSession();

        list($route, $action) = $this->issueRoutes();

        if ($route == 'index' && empty($action)) {
            if (!empty($this->session::getUserID())) {
                header('Location: /posts');
                exit();
            }
            $controller = new Controller\FrontController($this->session);
            return $controller->index();
        }

        if ($route == 'user' && $action == 'register') {
            $controller = new Controller\UserController();
            $controller->register();
            return 0;
        }

        if ($route == 'user' && $action = 'login') {
            $controller = new Controller\UserController($this->session);
            $controller->login($_POST);
            return 0;
        }

        if ($route == 'posts') {
            if (empty($this->session::getUserID())) {
                header('Location: /');
                exit();
            }
            $controller = new Controller\PostController($this->session);
            $controller->index();
            return 0;
        }

        if ($route == 'api' && $action = 'getmessages') {
            $controller = new Controller\APIController();
            $controller->getMessages();
            return 0;
        }

        $controller = new \App\Controllers\Err404Controller();
        $controller->index();
        return 0;
    }

    /**
     * @return array
     * *************
     * Получение путей из адрессной строки
     * Анализируется только первая и вторая часть адресной строки после домена
     * Для удобства набора адреса существуют сокращенные комбинации, указанные в массие $correctRoute
     * Например: адрес <domen>/login тождественен адресу <domen>/user/login
     */

    private function issueRoutes()
    {
        $correctRoute = [
            '' => ['index', ''],
            'login' => ['user', 'login'],
            'register' => ['user', 'register'],
            'post' => ['posts', 'index']
        ];

        $uris = explode('/', mb_strtolower(trim($_SERVER['REQUEST_URI'], " \t\n\r\0\x0B/")));

        $uris[1] = $uris[1] ?? '';

        if (array_key_exists($uris[0], $correctRoute)) {
            $replace = $correctRoute[$uris[0]];
            $uris[0] = $replace[0];
            $uris[1] = $replace[1];
        };

        return $uris;
    }
}

<?php
namespace Base;

use App\Controllers as Controller;

class Application
{
    const REQUIRED_AUTH = 1;
    const REQUIRED_ADMIN = 2;
    const REQUIRED_ANY = 3;

    protected $session;

    public function run()
    {
        session_start();
        $this->session = Session::getSession();

        list($route, $action) = $this->issueRoutes();

        if ($route == 'index' && empty($action)) {
            if ($this->session::userIsAuth()) {
                header('Location: /posts');
                exit();
            }
            $controller = new Controller\FrontController();
            $controller->index();
            return 0;
        }

        if ($route == 'user' && $action == 'register') {
            $controller = new Controller\UserController($this->session);
            $controller->register($_POST, $_FILES, 'login', '');
            return 0;
        }

        if ($route == 'user' && $action == 'login') {
            $controller = new Controller\UserController($this->session);
            $controller->login($_POST, 'posts', '');
            return 0;
        }

        if ($route == 'user' && $action == 'logout') {
            $controller = new Controller\UserController($this->session);
            $controller->logout();
            header('Location: /');
            exit();
        }

        if ($route == 'posts' && empty($action)) {
            if (!self::accessControl(self::REQUIRED_AUTH)) {
                return 0;
            }

            $controller = new Controller\PostController($this->session);
            if ($controller->index($_GET, $_POST, $_FILES)) {
                header('Location: /posts');
                exit();
            };
            return 0;
        }

        if ($route == 'api' && $action == 'getmessages') {
            $controller = new Controller\APIController();
            $controller->getMessages($_GET);
            return 0;
        }

        if ($route == 'admin') {
            if (!self::accessControl(self::REQUIRED_ADMIN)) {
                return 0;
            }

            $controller = new Controller\AdminController($this->session);

            $result = false;
            switch ($action) {
                case '':
                    $controller->index();
                    break;
                case 'delete':
                    $result = $controller->delete($_GET);
                    break;
                case 'edit':
                    $result = $controller->edit($_GET, $_POST, $_FILES);
                    break;
                case 'add':
                    $result = $controller->add($_POST, $_FILES);
                    break;
            }

            if ($result) {
                header('Location: /admin');
                exit();
            }

            return 0;
        }

        $controller = new \App\Controllers\Err404Controller();
        $controller->index();
        return 0;
    }

    protected static function accessControl($accessLevel = self::REQUIRED_ANY): bool
    {
        if (Session::userIsGuest() && ($accessLevel == self::REQUIRED_AUTH || $accessLevel == self::REQUIRED_ADMIN)) {
            $controller = new Controller\FrontController();
            $controller->index();
            return false;
        }
        if (!Session::userIsAdmin() && $accessLevel == self::REQUIRED_ADMIN) {
            $controller = new Controller\FrontController();
            $controller->accessDenied();
            return false;
        }

        return $accessLevel = self::REQUIRED_ANY;
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
            'logout' => ['user', 'logout'],
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

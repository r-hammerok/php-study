<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    private const MIN_LEN_PASSWORD = 4;

    public function login()
    {
        if (empty($_POST)) {
            $this->render('user/loginForm', []);
            return 0;
        }
        $validateResult = self::checkForm($_POST);

        if (!empty($validateResult['errors'])) {
            $this->render('user/loginForm', $validateResult);
            return 0;
        }

        $validateData = $validateResult['values'];
        $user = new User();
        $userData = $user->getData($validateData['email']);

        if (empty($userData) || !password_verify($validateData['password'], $userData['password'])) {
            $this->render('user/loginForm', ['errors' => [0 => 'This user does not exist']]);
            return 0;
        }

        $this->session::setUserID($userData['id']);
        header('Location: /posts');
        exit();
    }

    public function register()
    {
        if (!$_POST) {
            $this->render('user/registerForm');
            return 0;
        }

        $validateResult = self::checkForm($_POST);

        if (!empty($validateResult['errors'])) {
            $this->render('user/registerForm', $validateResult);
            return 0;
        }

        $validateData = $validateResult['values'];
        $user = new User();
        $returnData = $user->getData($validateData['email']);

        if (!empty($returnData)) {
            $this->render('user/registerForm', ['errors' => [0 => 'User already exists']]);
            return 0;
        }

        $validateData['regDate'] = date('Y-m-d H:i:s');
        if (!$user->saveData($validateData)) {
            $this->render('user/registerForm', ['errors' => [0 => 'Error writing to database']]);
            return 0;
        }

        header('Location: /user/login');
        exit();
    }

    /**
     * @param array $data
     * @return array
     */
    private function checkForm(array $data)
    {
        $errors = [];
        $values = [];

        if (isset($data['name'])) {
            $name = htmlentities(trim($data['name']));
            if (empty($name)) {
                $errors[] = 'Name field is not filled';
            } else {
                $values['name'] = $name;
            }
        }

        if (empty($data['email'])) {
            $errors[] = 'Email field is not filled';
        } else {
            $values['email'] = htmlentities(trim($data['email']));
        }

        if (empty($data['password'])) {
            $errors[] = 'Password field is not filled';
        } else {
            $values['password'] = $data['password'];
        }

        if (isset($data['password_again'])) {
            // Если такое поле существует, то значит проверяем форму Регистрации
            if (mb_strlen($data['password']) < self::MIN_LEN_PASSWORD) {
                $errors[] = 'Password must be at least 4 characters';
            } elseif (strcmp($data['password'], $data['password_again']) != 0) {
                $errors[] = 'Password mismatch';
            } else {
                $values['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
        }

        if (empty($errors)) {
            return ['values' => $values];
        }
        return ['errors' => $errors];
    }
}

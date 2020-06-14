<?php
namespace App\Controllers;

use App\Models\User;
use Cassandra\Varint;

class UserController extends BaseController
{
    const MIN_LEN_PASSWORD = 4;

    public function showLoginForm()
    {
        $data = [];
        if ($_POST) {
            $validateResult = self::validateFormData($_POST);

            if (isset($validateResult['errors'])) {
                $data['errors'] = $validateResult['errors'];
            } else {
                $validateData = $validateResult['values'];
                $user =  new User();
                $result = $user->getDataFromDb($validateData['email']);
                $userData = $result[0];

                if ($result === null) {
                    $data['errors'] = ['errors' => 'Database Exception (getDataFromDb)'];
                } elseif (empty($result) ||
                    !self::verifyPasswordHash($validateData['password'], $userData['password'])) {
                    $data['errors'] = ['errors' => 'This user does not exist'];
                } else {
                    $data['success'] = true;
                    $_SESSION['user_id'] = $userData['id'];
                }
            }
        }

        if ($data['success']) {
            header('Location: /');
            exit();
        }
        $this->render('user/loginForm', $data);

    }

    public function showRegisterForm()
    {
        $data = [];
        if ($_POST) {
            $validateResult = self::validateFormData($_POST);
            if (empty($validateResult['errors'])) {
                $validateData = $validateResult['values'];
                $user =  new User();
                $returnData = $user->getDataFromDb($validateData['email']);

                if ($returnData === null) {
                    $data['errors'] = ['errors' => 'Database Exception (getDataFromDb)'];
                } elseif (!empty($returnData)) {
                    $data['errors'] = ['errors' => 'This user already exists'];
                } else {
                    $success = $user->setData($validateData)->saveDataInDb();
                    if (!$success) {
                        $data['errors'] = ['errors' => 'Database Exception (saveDataInDb)'];
                    } else {
                        $data['success'] = true;
                    }
                }
            } else {
                $data['errors'] = $validateResult['errors'];
            }
        }

        if ($data['success']) {
            header('Location: user/loginForm');
            exit();
        }

        $this->render('user/registerForm', $data);
    }

    /**
     * @param array $data
     * @return array
     */
    private function validateFormData(array $data)
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

        if (isset($data['password_again'])) {
            // Если есть такое поле, то значит проверяем поля из формы Регистрации
            if (mb_strlen($data['password']) < self::MIN_LEN_PASSWORD) {
                $errors[] = 'Password must be at least 4 characters';
            } elseif (strcmp($data['password'], $data['password_again']) != 0) {
                $errors[] = 'Password mismatch';
            } else {
                $values['password'] = self::getPasswordHash($data['password']);
            }
        } else {
            if (mb_strlen($data['password']) == 0) {
                $errors[] = 'Password field is not filled';
            } else {
                $values['password'] = $data['password'];
            }
        }
        if (empty($errors)) {
            return ['values' => $values];
        } else {
            return ['errors' => $errors];
        }
    }

    /**
     * @param $password
     * @return false|string|null
     */
    private function getPasswordHash($password)
    {
        return password_hash((string) $password, PASSWORD_DEFAULT);
    }

    private function verifyPasswordHash($password, $hash)
    {
        return password_verify($password, $hash);
    }
}

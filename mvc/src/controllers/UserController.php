<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function login(
        array $post,
        string $redirectOnSuccess = '',
        string $redirectOnCancel = '',
        string $formAction = 'login'
    ) {
        $this->templateName = 'loginForm.twig';
        $this->renderType = self::RENDER_TYPE_TWIG;
        $this->templateData['formAction'] = trim($formAction);

        $validate = self::preAction($post, $redirectOnCancel);
        if ($validate === null) {
            return 0;
        }

        $user = User::getData($validate['email']);
        if (empty($user) || !password_verify($validate['password'], $user['password'])) {
            $this->templateData['errors'] = ['This user does not exist'];
            $this->render();
            return 0;
        }

        $this->session::setUserID($user['id']);
        header('Location: /' . $redirectOnSuccess);
        exit();
    }

    public function logout()
    {
        $this->session::clearSession();
        return 0;
    }

    public function register(
        array $post,
        array $files,
        string $redirectOnSuccess = '',
        string $redirectOnCancel = '',
        string $formAction = 'register'
    ) {
        $this->templateName = 'registerForm.twig';
        $this->renderType = self::RENDER_TYPE_TWIG;
        $this->templateData['formAction'] = trim($formAction);

        $validate = self::preAction($post, $redirectOnCancel);
        if ($validate === null) {
            return 0;
        }

        if (User::recordIsExist('email', $validate['email'])) {
            $this->templateData['errors'] = ['User already exists'];
            $this->render();
            return 0;
        }

        $validate['photo'] = '';
        if (!empty($files['photo']['tmp_name'])) {
            $tmp_name = $files['photo']['tmp_name'];
            $file = self::getRandomFileName($files['photo']['name']);
            move_uploaded_file($tmp_name, __DIR__ . WEB_DIR . PHOTO_HTML_DIR . $file);
            $validate['photo'] = $file;
        }

        User::insertData($validate);

        header('Location: /' . $redirectOnSuccess);
        exit();
    }

    public function edit(
        int $id,
        array $post,
        array $files,
        string $redirectOnSuccess = '',
        string $redirectOnCancel = '',
        string $formAction = 'edit'
    ) {
        $user = User::getData($id);
        if (empty($user)) {
            header('Location: /' . $redirectOnCancel);
            exit();
        }

        $this->templateName = 'editForm.twig';
        $this->renderType = self::RENDER_TYPE_TWIG;
        $this->templateData['formAction'] = trim($formAction) . '/?user_id=' . $id;
        $this->templateData['imgSRC'] = PHOTO_HTML_DIR;

        self::fillFormValues($user);

        $validate = self::preAction($post, $redirectOnCancel);
        if ($validate === null) {
            return 0;
        }

        if ($user['name'] == $validate['name'] && $user['email'] == $validate['email'] &&
            empty($files['photo']['tmp_name'])) {
            header('Location: /' . $redirectOnSuccess);
            exit();
        }

        if ($validate['email'] != $user['email'] &&
            User::recordIsExist('email', $validate['email'])) {
            $this->templateData['errors'] = ['Another user registered with this email'];
            $this->render();
            return 0;
        }

        $validate['photo'] = '';
        if (!empty($files['photo']['tmp_name'])) {
            $tmp_name = $files['photo']['tmp_name'];
            $file = self::getRandomFileName($files['photo']['name']);
            move_uploaded_file($tmp_name, __DIR__ . WEB_DIR . PHOTO_HTML_DIR . $file);
            $validate['photo'] = $file;
        }

        User::updateData($id, $validate);
        header('Location: /' . $redirectOnSuccess);
        exit();
    }

    /**
     * @param array $post
     * @param string $toRedirect
     * @return mixed|null
     */

    protected function preAction(array $post, string $toRedirect)
    {
        if (!$post) {
            $this->render();
            return null;
        }

        // Если нажата кнопка "Cancel"
        if (isset($post['cancel'])) {
            header('Location: /' . $toRedirect);
            return null;
        }

        // Заполняем массив значениями по умолчанию для полей формы
        self::fillFormValues($post);

        // Проверяем переданные значения
        $validate = self::checkForm($post);

        if (!empty($validate['errors'])) {
            $this->templateData['errors'] = $validate['errors'];
            $this->render();
            return null;
        }

        return $validate['values'];
    }
}

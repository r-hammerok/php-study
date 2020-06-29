<?php
namespace App\Controllers;

use App\Models\User;

class AdminController extends BaseController
{
    public function index()
    {
        $this->templateName = 'admin.twig';
        $this->renderType = self::RENDER_TYPE_TWIG;
        $this->templateData = ['users' => User::getData(), 'adminID' => ADMIN_ID, 'imgSRC' => PHOTO_HTML_DIR];

        $this->render();
        return 0;
    }

    public function add(array $post, array $files)
    {
        $controller = new UserController();
        $controller->register($post, $files, 'admin', 'admin', 'admin/add');

        return 0;
    }

    public function delete(array $get)
    {
        $idDeletedUser = (int) $get['user_id'] ?? 0;
        if ($idDeletedUser !== ADMIN_ID) {
            User::deleteCurrent($idDeletedUser);
            return true;
        }

        return false;
    }

    public function edit(array $get, array $post, array $files)
    {
        $idEditedUser = empty($get['user_id']) ? 0 : (int) $get['user_id'];
        $controller = new UserController();
        return $controller->edit($idEditedUser, $post, $files, 'admin', 'admin', 'admin/edit');
    }

}
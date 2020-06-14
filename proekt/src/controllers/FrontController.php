<?php
namespace App\Controllers;

use App\Models\User;

class FrontController extends BaseController
{
    public function index()
    {
        $model = new User();
        $users = $model->all();
        $this->render('front\index', ['users' => $users]);
    }
}
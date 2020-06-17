<?php
namespace App\Controllers;

class FrontController extends BaseController
{
    protected $post;

    public function index()
    {
        $this->render('/index/mainPage');
        exit();
    }
}

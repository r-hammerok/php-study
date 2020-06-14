<?php
namespace App\Controllers;

class PostController
{
    public function index()
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /user/login/');
            exit;
        }





    }
}

<?php
namespace App\Controllers;

class Err404Controller extends BaseController
{
    public function index()
    {
        $this->render('index\404Page');
    }
}

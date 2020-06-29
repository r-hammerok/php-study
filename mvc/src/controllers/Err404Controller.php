<?php
namespace App\Controllers;

class Err404Controller extends BaseController
{
    public function index()
    {
        $this->templateName = 'index\404Page';
        $this->render();
    }
}

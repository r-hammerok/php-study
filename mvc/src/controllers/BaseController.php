<?php
namespace App\Controllers;

class BaseController
{
    protected function render($template, $data = [])
    {
        if (is_array($data)) {
            extract($data);
        }
        include __DIR__ . '\..\views\\' . $template . '.php';
    }
}

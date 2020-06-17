<?php
namespace App\Controllers;

use Base\Session;

class BaseController
{
    protected const VIEW_TEMPLATE = '/../views/template/templatePage.php';

    protected $session;

    public function __construct(Session $session = null)
    {
        if ($session !== null) {
            $this->session = $session;
        }
    }

    protected function render($viewContent, $data = [])
    {
        include __DIR__ . self::VIEW_TEMPLATE;
    }
}

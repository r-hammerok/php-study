<?php
namespace App\Controllers;

class FrontController extends BaseController
{
    protected $post;

    public function index()
    {
        $this->templateName = 'mainPage.twig';
        $this->renderType = self::RENDER_TYPE_TWIG;
        $this->render();
        return 0;
    }

    public function accessDenied()
    {
        $this->templateName = 'accessDenied.twig';
        $this->renderType = self::RENDER_TYPE_TWIG;
        $this->render();
        return 0;
    }
}

<?php
namespace App\Controllers;

use Base\Session;

class BaseController
{
    const VIEW_TEMPLATE = '\..\views\template\templatePage.php';
    const TWIG_PATH_TPL =   '\..\views\twig\templates';
    const TWIG_PATH_CACHE = '\..\views\twig\cache';

    const RENDER_TYPE_NATIVE = 1;
    const RENDER_TYPE_TWIG = 2;

    protected $session;

    private $twig;

    public function __construct(Session $session = null)
    {
        if ($session !== null) {
            $this->session = $session;
        }
    }

    protected function render($viewContent, $data = [], $renderType = self::RENDER_TYPE_NATIVE)
    {
        switch ($renderType) {
            case self::RENDER_TYPE_NATIVE:
                include __DIR__ . self::VIEW_TEMPLATE;
                break;

            case self::RENDER_TYPE_TWIG:
                $twig = $this->getTwig();
                try {
                    echo $twig->render($viewContent, $data);
                } catch (\Exception $e) {
                    trigger_error($e->getMessage());
                }
        }
    }

    protected function getTwig()
    {
        if (!$this->twig) {
            $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . self::TWIG_PATH_TPL);
            $this->twig = new \Twig\Environment(
                $loader,
                [
                    'cache' => __DIR__ . self::TWIG_PATH_CACHE,
                    'auto_reload' => DEVELOPMENT === 1 ? true : false
                ]
            );
        }

        return $this->twig;
    }
}

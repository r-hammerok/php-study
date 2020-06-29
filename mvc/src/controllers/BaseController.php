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
    protected $renderType = self::RENDER_TYPE_NATIVE;
    protected $templateName;
    protected $templateData = [];

    private $twig;

    public function __construct(Session $session = null)
    {
        if ($session !== null) {
            $this->session = $session;
        }
    }

    protected function render()
    {
        switch ($this->renderType) {
            case self::RENDER_TYPE_NATIVE:
                include __DIR__ . self::VIEW_TEMPLATE;
                break;

            case self::RENDER_TYPE_TWIG:
                $twig = $this->getTwig();
                try {
                    echo $twig->render($this->templateName, $this->templateData);
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

    /**
     * @param string $originFileName
     * @return string
     */
//    protected function randomFileName($extension = false)
    protected function getRandomFileName(string $originFileName): string
    {
        $file = '';
        if ($originFileName) {
            $extension = strtolower(substr(strrchr($originFileName, '.'), 1));
            $extension = $extension ? '.' . $extension : '';
            do {
                $name = substr(md5(microtime() . rand(0, 1000)), 0, 10);
                $file = $name . $extension;
            } while (file_exists($file));
        }
        return $file;
    }

    protected function fillFormValues(array $data)
    {
        $default = [];
        if (isset($data['email'])) {
            $default['email'] = $data['email'];
        }
        if (isset($data['name'])) {
            $default['name'] = $data['name'];
        }
        if (isset($data['id'])) {
            $default['id'] = $data['id'];
        }
        if (isset($data['photo'])) {
            $default['photo'] = $data['photo'];
        }

        $this->templateData['defaultValues'] = $default;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function checkForm(array $data): array
    {
        $errors = [];
        $values = [];

        if (isset($data['id'])) {
            $values['id'] = (int) $data['id'];
        }

        if (isset($data['name'])) {
            $name = htmlentities(trim($data['name']));
            if (empty($name)) {
                $errors[] = 'Name field is not filled';
            } else {
                $values['name'] = $name;
            }
        }

        if (empty($data['email'])) {
            $errors[] = 'Email field is not filled';
        } else {
            $values['email'] = htmlentities(trim($data['email']));
        }

        if (isset($data['password'])) {
            if (empty($data['password'])) {
                $errors[] = 'Password field is not filled';
            } else {
                $values['password'] = $data['password'];
            }
        }

        if (isset($data['password_again'])) {
            // Если такое поле существует, то значит проверяем форму Регистрации
            if (mb_strlen($data['password']) < MIN_LEN_PASSWORD) {
                $errors[] = 'Password must be at least ' . MIN_LEN_PASSWORD . ' characters';
            } elseif (strcmp($data['password'], $data['password_again']) != 0) {
                $errors[] = 'Password mismatch';
            } else {
                $values['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
        }

        if (empty($errors)) {
            return ['values' => $values];
        }
        return ['errors' => $errors];
    }
}

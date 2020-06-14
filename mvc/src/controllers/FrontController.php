<?php
namespace App\Controllers;

use App\Models\post;
use Base\Session;

define('IMG_DIR', '\..\..\public_html\img\posts\\');
define('IMG_HTML_DIR', '\img\posts\\');
class FrontController extends BaseController
{
    protected $post;
    protected $session;

    public function index()
    {
        $this->session = New Session();
        $this->session->setUserID($_SESSION['user_id']);
        $data = [];

        if (empty($this->session->getUserID())) {
            $this->render('index\mainPage');
        } else {
            $this->post = new post();

            if (isset($_GET['delete']) && $_SESSION['user_id'] == ADMIN_ID) {
                $idPost = (int) $_GET['delete'];
                $this->post->deletePostFromDB($idPost);
            }

            if (isset($_POST['post'])) {
                $message = htmlentities(trim($_POST['post']));
                if (empty($message)) {
                   $data['errors'] = ['error' => 'Message field is not filled'];
                } else {
                    $file = null;
                    $tmp_name ='';
                    if (!empty($_FILES['img-post']['tmp_name'])) {
                        $tmp_name = $_FILES['img-post']['tmp_name'];
                        $extension = strtolower(substr(strrchr($_FILES['img-post']['name'], '.'), 1));
                        $file = self::randomFileName($extension);
                    }
                    $success = $this->post->setPost($message, $this->session->getUserID(), $file)->savePostInDB();
                    if (!$success) {
                        $data['errors'] = ['errors' => 'Database Exception (getDataFromDb)'];
                    } elseif (!empty($file)) {
                        move_uploaded_file($tmp_name, IMG_DIR . $file);
                    }
                }
            }
            $data['messages'] = $this->post->getPostsFromDB();
            $this->render('post\blogPage', $data);
        }
    }

    /**
     * @param bool $extension
     * @return string
     */
    protected function randomFileName($extension = false)
    {
        $extension = $extension ? '.' . $extension : '';
        do {
            $name = substr(md5(microtime() . rand(0, 1000)), 0, 10);;
            $file = $name . $extension;
        } while (file_exists($file));

        return $file;
    }
}

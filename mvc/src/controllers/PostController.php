<?php
namespace App\Controllers;

use App\Models\Post;

class PostController extends BaseController
{
    public function index()
    {
        $post = new Post();

        if (isset($_GET['delete']) && $this->session::getUserID() == ADMIN_ID) {
            $post->delete($_GET['delete']);
        }

        $data['messages'] = $post->getPosts($post::POSTS_ALL_USERS, POST_DISPLAY_LIMIT);

        if (empty($_POST)) {
            $this->render('post\blogPage', $data);
            return 0;
        }

        $message = htmlentities(trim($_POST['post']));
        if (empty($message)) {
            $data['errors'] = [0 => 'Message field is not filled'];
            $this->render('post\blogPage', $data);
            return 0;
        }

        $newPost['imgName'] = null;
        if (!empty($_FILES['img-post']['tmp_name'])) {
            $tmp_name = $_FILES['img-post']['tmp_name'];
            $extension = strtolower(substr(strrchr($_FILES['img-post']['name'], '.'), 1));
            $file = self::randomFileName($extension);
            move_uploaded_file($tmp_name, __DIR__ . IMG_DIR . $file);
            $newPost['imgName'] = $file;
        }

        $newPost['text'] = $message;
        $newPost['createdAt'] = date('Y-m-d H:i:s');
        $newPost['ownerId'] = $this->session->getUserID();

        $post->save($newPost);
        $data['messages'] = $post->getPosts($post::POSTS_ALL_USERS, POST_DISPLAY_LIMIT);

        header('Location: /posts');
        exit();
    }

    /**
     * @param bool $extension
     * @return string
     */
    protected function randomFileName($extension = false)
    {
        $extension = $extension ? '.' . $extension : '';
        do {
            $name = substr(md5(microtime() . rand(0, 1000)), 0, 10);
            $file = $name . $extension;
        } while (file_exists($file));

        return $file;
    }
}

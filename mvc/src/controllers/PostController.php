<?php
namespace App\Controllers;

use App\Models\Post;

class PostController extends BaseController
{
    public function index(array $get, array $post, array $files)
    {
        if (isset($get['delete']) && $this->session::userIsAdmin()) {
            Post::deleteCurrent((int) $get['delete']);
            return true;
        }

        $this->templateName = 'blogPage.twig';
        $this->renderType = self::RENDER_TYPE_TWIG;
        $this->templateData['formAction'] = 'posts';
        $this->templateData['messages'] = Post::getPosts(Post::POSTS_ALL_USERS, POST_DISPLAY_LIMIT);
        $this->templateData['isAdmin'] = $this->session::userIsAdmin();
        $this->templateData['imgDIR'] = IMG_HTML_DIR;

        if (empty($post)) {
            $this->render();
            return false;
        }

        $message = htmlentities(trim($post['post']));
        if (empty($message)) {
            $this->templateData['errors'] = ['Message field is not filled'];
            $this->render();
            return false;
        }

        $newPost['text'] = $message;
        $newPost['owner_id'] = $this->session->getUserID();

        $newPost['img_name'] = '';

        if (!empty($files['img-post']['tmp_name'])) {
            $tmp_name = $files['img-post']['tmp_name'];
            $file = self::getRandomFileName($files['img-post']['name']);
            move_uploaded_file($tmp_name, __DIR__ . IMG_DIR . $file);
            $newPost['img_name'] = $file;
        }

        Post::insertData($newPost);

        header('Location: /posts');
        exit();
    }
}

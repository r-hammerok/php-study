<?php
namespace App\Controllers;

use App\Models\Post;

class APIController extends BaseController
{
    public function getMessages(array $get)
    {
        $userId = isset($get['user_id']) ? (int) $get['user_id'] : 0;
        $result = Post::getPosts($userId, POST_GETAPI_LIMIT, true);

        $this->templateName = 'index/apiResultPage';
        $this->templateData = $this->response('Data not found', 404);

        if ($result) {
            $this->templateData = $this->response($result, 200);
        }

        $this->render();
        exit();
    }

    /**
     * @param $data
     * @param int $status
     * @return false|string
     */
    private function response($data, $status = 500)
    {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data);
    }

    /**
     * @param $code
     * @return mixed
     */
    private function requestStatus($code)
    {
        $status = [
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        ];
        return ($status[$code]) ? $status[$code] : $status[500];
    }
}


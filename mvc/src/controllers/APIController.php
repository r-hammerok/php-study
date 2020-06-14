<?php
namespace App\Controllers;

use App\Models;

class APIController extends BaseController
{
    public function getMessages()
    {
        $user_id = (int) $_GET['user_id'];

        if ($user_id > 0) {
            $result = (new Models\post())->getPostsFromDB($user_id);
            if ($result) {
                $return = $this->response($result, 200);
                $this->render('index\apiResultPage', $return);
                exit();
            }
        }
        $return = $this->response('Data not found', 404);
        $this->render('index\apiResultPage', $return);
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


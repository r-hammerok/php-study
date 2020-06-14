<?php
namespace App\Models;

use Base;

class post
{
    protected $text;
    protected $createdAt;
    protected $ownerId;
    protected $imgName = null;

    /**
     * @return array|null
     */
    public function getPostsFromDB()
    {
        $query = "SELECT p.id, p.created_at, p.owner_id, p.text, u.name, p.img_name FROM posts p LEFT JOIN users u ON p.owner_id = u.id ORDER BY p.created_at DESC LIMIT 20;";
        return Base\db::fetchAll($query);
    }

    /**
     * @return mixed
     */
    public function getUrlImg()
    {
        return $this->urlImg;
    }

    /**
     * @return bool
     */
    public function savePostInDB()
    {
        $query = "INSERT INTO posts (created_at, owner_id, text, img_name) VALUES (:createdAt, :ownerId, :message, :imgName)";
        $values = self::getPost();

        return Base\db::execute($query, $values);
    }

    /**
     * @param $message
     * @param $ownerId
     * @param string $imgName
     * @return $this
     */
    public function setPost($message, $ownerId, $imgName = null)
    {

        $this->text = $message;
        $this->createdAt = date('Y-m-d H:m:s');
        $this->ownerId = $ownerId;
        $this->imgName = $imgName;

        return $this;
    }

    /**
     * @return array
     */
    protected function getPost()
    {
        return [
            'message' =>  $this->text,
            'createdAt' => $this->createdAt,
            'ownerId' => $this->ownerId,
            'imgName' => $this->imgName
        ];
    }
}

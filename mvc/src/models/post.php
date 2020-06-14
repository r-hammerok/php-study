<?php
namespace App\Models;

use Base;

class post
{
    protected $text;
    public $createdAt;
    protected $ownerId;
    protected $imgName = null;

    /**
     * @param null $owner_id
     * @return array|null
     */
    public function getPostsFromDB($owner_id = null)
    {
        $owner_id = (int) $owner_id;

        if ($owner_id <= 0) {
            $query = "SELECT p.id, p.created_at, p.owner_id, p.text, u.name, p.img_name FROM posts p LEFT JOIN users u ON p.owner_id = u.id ORDER BY p.created_at DESC LIMIT 20;";
            return Base\db::fetchAll($query);
        }

        $query = "SELECT p.id, p.created_at, p.owner_id, p.text, u.name, p.img_name FROM posts p LEFT JOIN users u 
ON p.owner_id = u.id WHERE p.owner_id = :ownerId ORDER BY p.created_at DESC LIMIT 20;";

        return Base\db::fetchAll($query, ['ownerId' => $owner_id]);
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

    public function deletePostFromDB($id)
    {
        $query = "DELETE FROM posts WHERE id = :id";

        return Base\db::execute($query, ['id' => $id]);
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
        $this->createdAt = date('Y-m-d H:i:s');
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

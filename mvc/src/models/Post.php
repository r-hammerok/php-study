<?php
namespace App\Models;

use Base;

class Post
{
    public const POSTS_ALL_USERS = 0;

    protected $text;
    protected $createdAt;
    protected $ownerId;
    protected $imgName;

    public function getPosts(int $ownerId = self::POSTS_ALL_USERS, int $limit = 0)
    {
        $condition = '';
        if ($ownerId != 0) {
            $condition = ' WHERE p.owner_id = ' . $ownerId;
        }

        $queryLimit = $limit = 0 ? '' : " LIMIT $limit";
        $query = "SELECT p.id, p.created_at, p.owner_id, p.text, u.name, p.img_name FROM posts p LEFT JOIN users u ON p.owner_id = u.id" . $condition . " ORDER BY p.created_at DESC" . $queryLimit;

        return Base\db::query($query, Base\db::FETCH_ALL);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function save(array $data): bool
    {
        $query = "INSERT INTO posts (created_at, owner_id, text, img_name)
VALUES (:createdAt, :ownerId, :text, :imgName)";

        $result = Base\db::execute($query, $data);
        if ($result) {
            $this->text = $data['text'];
            $this->createdAt = $data['createdAt'];
            $this->ownerId = $data['ownerId'];
            $this->imgName = $data['imgName'];
        }

        return $result;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM posts WHERE id = " . $id;

        return Base\db::query($query);
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

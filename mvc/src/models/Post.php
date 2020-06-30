<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Base
{
    public const POSTS_ALL_USERS = 0;

    protected $fillable = ['owner_id', 'text', 'img_name'];


    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param int $ownerId
     * @param int $limit
     * @param bool $withUsers
     * @return array
     * Для $ownerId <> 0 возвращаем посты пользователя с соответствующим id , иначе - все посты.
     */
    public static function getPosts(int $ownerId = self::POSTS_ALL_USERS, int $limit = 0)
    {
        $query = self::query();
        if ($ownerId != 0) {
            $query->where('owner_id', '=', $ownerId);
        }

        $result = $query->with('owner')->get()->take($limit)->sortByDesc('created_at');

        if (!$result) {
            return [];
        }

        return $result->toArray();
    }
}

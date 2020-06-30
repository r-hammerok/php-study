<?php
namespace App\Models;

class User extends Base
{
    protected $guarded = ['id'];

    /**
     * @param $param
     * @return array
     * Возвращает запись из таблицы users.
     * Если переданный параметр - целое число, то запитсь ищется по полю id,
     * если переданный параметр - строка, то запись ищется по полю email?
     * если передан пустой параметр - возвращаются все записи
     */
    public static function getData($param = '')
    {
        $query = self::query();
        if (empty($param)) {
            $result = $query->get()->sortByDesc('id');
        } else {
            $field = is_int($param) ? 'id' : 'email';
            $result = $query->where($field, '=', $param)->first();
        }

        if (!$result) {
            return [];
        }
        return $result->toArray();
    }

    public static function recordIsExist(string $column, string $value): bool
    {
        return !empty(self::query()->where($column, $value)->first());
    }
}

<?php
namespace App\Models;

use Base;

class User
{
    protected $name;
    protected $id;
    protected $registrationDate;
    protected $email;
    protected $passwordHash;

    /**
     * @param $data
     * @return $this
     */
    protected function set($data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        };
        $this->name = $data['name'];
        $this->registrationDate = $data['reg_data'];
        $this->email = mb_strtolower($data['email']);
        $this->passwordHash = $data['password'];

        return $this;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function saveData(array $data): bool
    {
        $query = "INSERT INTO users (`name`, reg_data, email, password) VALUES (:name, :regDate, :email, :password)";
        $result = Base\db::execute($query, $data);
        if ($result) {
            self::set(self::getData($data['email']));
        }
        return $result;
    }

    /**
     * @param $param
     * @return array|false
     *
     * Возвращает запись из таблицы users.
     * Если переданный параметр - целое число, то запитсь ищется по полю id,
     * если переданный параметр - строка, то запись ищется по полю email.
    */
    public function getData($param)
    {
        if (is_int($param)) {
            $field = 'id';
        } else {
            $field = 'email';
        }
        $query = "SELECT * FROM users WHERE " . $field . " = :value";

        return Base\db::fetch($query, ['value' => $param]);
    }
}

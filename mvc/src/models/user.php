<?php
namespace App\Models;

use Base;

class User
{
    protected $name;
    protected $id = null;
    protected $registrationDate;
    protected $email;
    protected $passwordHash;

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        };

        $this->name = $data['name'];

        if (isset($data['regDate'])) {
            $this->registrationDate = $data['regDate'];
        } else {
            $this->registrationDate = date('Y-m-d H:m:s');
        };
        $this->email = mb_strtolower($data['email']);
        $this->passwordHash = $data['password'];

        return $this;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'regDate' => $this->registrationDate,
            'password' => $this->passwordHash
        ];
    }

    /**
     * @return bool
     */
    public function saveDataInDb()
    {
        $query = "INSERT INTO users (`name`, reg_data, email, password) VALUES (:name, :regDate, :email, :password)";
        $values = self::getData();

        return Base\db::execute($query, $values);
    }

    /**
     * @param $param
     * @return array|null
     *
     * Возвращает запись из таблицы users.
     * Если переданный параметр - целое число, то запитсь ищется по полю id,
     * если переданный параметр - строка, то запись ищется по полю email.
    */
    public function getDataFromDb($param)
    {
        if (is_int($param)) {
            $field = 'id';
        } elseif (is_string($param)) {
            $field = 'email';
        } else {
            return null;
        }
        $query = "SELECT * FROM users WHERE " . $field . " = :value";

        return Base\db::fetchAll($query, ['value' => $param]);
    }
}

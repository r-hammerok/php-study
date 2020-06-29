<?php
namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class Base extends Model
{
    use SoftDeletes;

    protected static $instances;

    public static function initConnection()
    {
        if (!self::$instances) {
            self::$instances = new Capsule();
            self::$instances->addConnection([
                'driver' => DBDRIVER,
                'host' => DBHOST,
                'database' => DBNAME,
                'username' => DBUSER,
                'password' => DBPASSWORD,
                'charset' => DBCHARSET,
                'collation' => 'utf8_unicode_ci',
                'prefix' => ''
            ]);
            self::$instances->bootEloquent();
        }
        return self::$instances;
    }
    /**
     * @param array $data
     * @return Base
     */
    public static function insertData(array $data): Base
    {
        self::initConnection();
        return self::create($data);
    }

    public static function deleteCurrent(int $id)
    {
        self::initConnection();
        return self::destroy($id);
    }

    public static function updateData(int $id, array $data)
    {
        self::initConnection();
        return self::query()->find($id)->update($data);
    }
}

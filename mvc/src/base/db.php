<?php
namespace Base;

class db
{
    protected static $instances = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    protected static function getConnection()
    {
        if (self::$instances === null) {
            $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=" . CHARSET;
            self::$instances = new \PDO($dsn, USER, PASSWORD);
        }
        return self::$instances;
    }

    public static function execute($query, $values = [])
    {
        $dbo = self::getConnection();
        return $dbo->prepare($query)->execute($values);
    }

    public static function fetchAll($query, $values = [])
    {
        $sth = self::getConnection()->prepare($query);
        if ($sth->execute($values)) {
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
        return null;
    }
}

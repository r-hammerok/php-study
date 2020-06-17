<?php
namespace Base;

class DB
{
    public const FETCH_ONLY_FIRST = 1;
    public const FETCH_ALL = 2;

    protected static $instances;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return \PDO
     */
    protected static function getConnection()
    {
        if (!self::$instances) {
            $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=" . CHARSET;
            self::$instances = new \PDO($dsn, USER, PASSWORD);
        }
        return self::$instances;
    }

    /**
     * @param $query
     * @param int $mode
     * @return array|mixed
     */
    public static function query($query, $mode = self::FETCH_ONLY_FIRST)
    {
        $sth = self::getConnection()->query($query);
        if ($mode === self::FETCH_ONLY_FIRST) {
            return $sth->fetch(\PDO::FETCH_ASSOC);
        }

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $query
     * @param array $values
     * @param int $mode
     * @return array|mixed
     */
    public static function fetch($query, $values = [], $mode = self::FETCH_ONLY_FIRST)
    {
        $sth = self::getConnection()->prepare($query);
        $sth->execute($values);

        if ($mode === self::FETCH_ONLY_FIRST) {
            return $sth->fetch(\PDO::FETCH_ASSOC);
        }

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $query
     * @param array $values
     * @return bool
     */
    public static function execute($query, $values = [])
    {
        return self::getConnection()->prepare($query)->execute($values);
    }
}

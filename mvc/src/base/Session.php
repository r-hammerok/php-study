<?php
namespace Base;

class Session
{
    private static $session;
    private static $userId;

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getSession()
    {
        if (self::$session === null) {
            self::$session = new self;
        }
        self::$userId = $_SESSION['user_id'] ?? 0;

        return self::$session;
    }

    public static function getUserID()
    {
        return self::$userId;
    }

    public static function setUserID(int $newUserId)
    {
        self::$userId = $newUserId;
        $_SESSION['user_id'] = self::$userId;
    }
}

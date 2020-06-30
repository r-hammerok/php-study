<?php
namespace Base;

class Session
{
    private static $session;
    private static $userId;

    private function __construct()
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

    public static function clearSession()
    {
        self::$userId = null;
        unset($_SESSION['user_id']);
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

    public static function userIsAuth()
    {
        return !empty(self::$userId);
    }

    public static function userIsAdmin()
    {
        return self::$userId === ADMIN_ID;
    }

    public static function userIsGuest()
    {
        return empty(self::$userId);
    }
}

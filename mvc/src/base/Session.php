<?php
namespace Base;

class Session
{
    protected $userID;

    public function __construct($userId)
    {
        $this->userID = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }
}

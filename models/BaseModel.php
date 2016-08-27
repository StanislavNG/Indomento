<?php

abstract class BaseModel
{
    protected static $db;

    public function __construct()
    {
        if (self::$db == null) {
            self::$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            self::$db->set_charset("utf8");
            if (self::$db->connect_errno) {
                die('Cannot connect to database');
            }
        }
    }

    function getLatestPosts(int $maxCount)
    {
        $statement = self::$db->query(
            "SELECT posts.id, title, content, date, full_name ".
            "FROM posts LEFT JOIN users on posts.user_id = users.id " .
            "ORDER BY date DESC LIMIT " . $maxCount);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}

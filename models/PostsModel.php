<?php

class PostsModel extends HomeModel
{
    function getALL()
    {
        $statement = self::$db->query(
            "SELECT posts.id, title, content, date, full_name, user_id ".
            "FROM posts LEFT JOIN users on posts.user_id = users.id " .
            "ORDER BY date DESC");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function create (string $title, string $content, string $user_id) : bool 
    {
        $statement = self::$db->prepare("INSERT INTO posts(title, content, user_id) VALUES(?, ?, ?)");
        $statement->bind_param("ssi", $title, $content, $user_id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

   

    public function delete(int $id) : bool 
    {
        $statement = self::$db->prepare("DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

    public function edit(int $id, string $title, string $content) 
    {
        $statement = self::$db->prepare("UPDATE posts SET title=:title, content=:content WHERE id=:id");
        $statement->bindParam(':title', $title);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->affected_rows == 1;
    }

}

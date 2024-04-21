<?php


namespace userClass;

use database\Database;

class User
{
    public function getUser($userId)
    {
        $db = new Database;
        $pdo = $db->connect();
        $statement = $pdo->prepare('select * from users where id = :id');
        $statement->bindValue(':id', $userId);
        $statement->execute();
    }
}

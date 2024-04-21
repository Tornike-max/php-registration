<?php

namespace registration;

use database\Database;

class Login
{
    protected $email;
    protected $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser()
    {
        if (strpos($this->email, '@') === true && strlen($this->password) > 6) {
            $db = new Database();
            $pdo = $db->connect();
            $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
            $statement->bindParam(':email', $this->email);
            $user = $statement->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($this->password, $user['password'])) {
                    echo 'Success';
                    header('Location: ./partials/homePage.php');
                } else {
                    header('Location: ./partials/login.php');
                }
            }
        }
    }
}

<?php

namespace registration;

require_once './vendor/autoload.php';

use database\Database;

class Register
{
    protected $full_name;
    protected $email;
    protected $password;
    protected $repeatPassword;

    public function __construct($full_name, $email, $password, $repeatPassword)
    {
        $this->full_name = $full_name;
        $this->email = $email;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;
    }

    public function registerUser()
    {
        if ($this->full_name && $this->email && $this->password && $this->repeatPassword) {
            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
            $db = new Database();
            $pdo = $db->connect();
            $statement = $pdo->prepare('insert into users (full_name,email,password) 
                                   values(:full_name,:email,:password)
        ');
            var_dump($statement);
            $statement->bindValue(':full_name', $this->full_name);
            $statement->bindValue(':email', $this->email);
            $statement->bindValue(':password', $hashed_password);
            if ($statement->execute()) {
                session_start();
                $_SESSION['user'] = [
                    'full_name' => $this->full_name,
                    'email' => $this->email
                ];
                header('Location: ./partials/homePage.php');
                exit();
            } else {
                header('Location: index.php?error=registrationFailed');
                exit();
            }
            // header('Location: ./partials/loginPage.php');
        } else {
            // header('Location: index.php');
        }
    }
}

<?php


namespace registration;


use database\Database;
use Exception;

class Login
{
    private $user;

    public function loginUser($email, $password)
    {
        if (!$this->validateCredentials($email, $password)) {
            echo 'Invalid email or password format.';
            return;
        }

        $db = new Database();
        $pdo = $db->connect();
        if (!$pdo) {
            echo 'Database connection failed';
            return;
        }

        $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $statement->bindParam(':email', $email);
        $statement->execute();
        $this->user = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($this->user && password_verify($password, $this->user['password'])) {
            header('Location: ./partials/homePage.php');

            exit();
        } else {
            echo 'Login failed: User not found or password does not match.';
        }
    }

    private function validateCredentials($email, $password)
    {
        return strpos($email, '@') !== false && strlen($password) > 6;
    }

    public function getUser()
    {
        if (!$this->user) {
            throw new Exception('No user information available.');
        }
        return $this->user;
    }
}

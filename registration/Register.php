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
    public $errors = [];

    public function __construct($full_name, $email, $password, $repeatPassword)
    {
        $this->full_name = $full_name;
        $this->email = $email;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;
    }

    public function validate()
    {
        if (strlen($this->full_name) < 5) {
            $this->errors[] = ['message' => 'Full name is required'];
        }
        if (strlen($this->email) < 5 && strpos($this->email, '@') === false) {
            $this->errors[] = ['message' => 'Email is required'];
        }
        if (strlen($this->password) < 6) {
            $this->errors[] = ['message' => 'Password is required'];
        }
        if (strlen($this->repeatPassword) < 6 && $this->repeatPassword !== $this->password) {
            $this->errors[] = ['message' => 'Full name is required'];
        }

        if (!empty($this->errors)) {
            foreach ($this->errors as $error) {
                echo "<div>$error</div>";
            }
        }
        return empty($this->errors);
    }

    public function registerUser()
    {
        $err = $this->validate();

        if ($err) {
            echo 'hello from register';

            if ($this->full_name && $this->email && $this->password && $this->repeatPassword) {
                $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
                $db = new Database();
                $pdo = $db->connect();
                $isUserExists = $pdo->prepare('select * from users where email = :email');
                $isUserExists->bindValue(':email', $this->email);
                $isUserExists->execute();
                if ($isUserExists->rowCount() > 0) {
                    echo 'something went wrong';
                    die();
                } else {
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
                }

                // header('Location: ./partials/loginPage.php');
            } else {
                // header('Location: index.php');
            }
        }
    }
}

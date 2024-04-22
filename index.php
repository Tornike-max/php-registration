<?php
session_start();

use database\Database;
use registration\Login;
use registration\Register;

require_once './vendor/autoload.php';

require_once './partials/registration.php';

$db = new Database();
$db->connect();

$method = $_SERVER['REQUEST_METHOD'] ?? null;

$queryString = $_SERVER['QUERY_STRING'] ?? null;


$full_name = '';
$email = '';
$password = '';
$repeatPassword = '';

if ($queryString && $method === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $login = new Login();
        $isLogin = $login->loginUser($email, $password);
        if ($isLogin) {
            $_SESSION['user'] = $login->getUser();
            header('Location: ./partials/homePage.php');
            exit();
        } else {
            echo 'Login failed';
        }
    }
}


if ($method === 'POST' && !$queryString) {
    echo 'main post';
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $errors = [];

    if (strlen($full_name) < 5) {
        $errors[] = ['message' => 'Full name is required'];
    }
    if (strlen($email) < 5 && strpos($email, '@') === false) {
        $errors[] = ['message' => 'Email is required'];
    }
    if (strlen($password) < 6) {
        $errors[] = ['message' => 'Password is required'];
    }
    if (strlen($repeatPassword) < 6 && $repeatPassword !== $password) {
        $errors[] = ['message' => 'Full name is required'];
    }

    $register = new Register(
        $full_name,
        $email,
        $password,
        $repeatPassword
    );
    $register->registerUser();
}

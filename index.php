<?php

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

    if (isset($email) && isset($password)) {
        $login = new Login($email, $password);
        $login->loginUser();
        header('Location: ./partials/homePage.php');
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

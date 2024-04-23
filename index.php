<?php
session_start();

use database\Database;
use registration\Logout;

require_once './vendor/autoload.php';

$db = new Database();
$db->connect();

$method = $_SERVER['REQUEST_METHOD'] ?? null;

$queryString = $_SERVER['QUERY_STRING'] ?? null;

$errors = [];

if ($method === 'POST' && strpos($queryString, 'logout') !== false) {
    $logout = new Logout();
    $logout->logoutUser();
}

if ($queryString && $method === 'GET') {
    $email = '';
    $password = '';
    $errors = [];

    $method = $_SERVER['REQUEST_METHOD'] ?? null;
    require_once './partials/loginPage.php';
} else if ($queryString && $method === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = [];

    $method = $_SERVER['REQUEST_METHOD'] ?? null;
    require_once './partials/loginPage.php';
}


if ($method === 'GET' && !$queryString) {
    echo 'get method';
    $full_name =  '';
    $email = '';
    $password = '';
    $repeatPassword = '';
    $errors = [];

    $method = $_SERVER['REQUEST_METHOD'] ?? null;
    require_once './partials/registration.php';
} else if ($method === 'POST' && !$queryString) {
    echo ' post method';
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $repeatPassword = $_POST['repeatPassword'] ?? '';

    $method = $_SERVER['REQUEST_METHOD'] ?? null;
    require_once './partials/registration.php';
}

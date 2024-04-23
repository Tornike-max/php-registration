<?php

namespace registration;


require_once './vendor/autoload.php';


class Logout
{
    public $session;
    public function __construct()
    {
        $this->session = isset($_SESSION['user']) ?? null;
        if (!$this->session) {
            echo 'No Acive Sessions';
            die();
        }
    }
    public function logoutUser()
    {
        if ($this->session) {
            session_destroy();
        }
    }
}

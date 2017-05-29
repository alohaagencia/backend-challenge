<?php

class SessionController 
{
    public function __construct()
    {
        if (!$this->hasSessionLogin()) {
            session_start();
        }
    }

    public function createSessionLogin($id, $name)
    {
        $_SESSION['login'] = array('user' => $name, 'id' => $id);
    }

    public function destroySessionLogin()
    {
        unset($_SESSION['login']);
        session_destroy();
        header("location:index.php");
    }

    public function hasSessionLogin()
    {
        return isset($_SESSION['login']);
    }
}
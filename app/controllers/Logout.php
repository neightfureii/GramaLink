<?php

class Logout
{
    public function index()
    {
        // Destroy session
        session_start();
        session_unset();
        session_destroy();

        // Redirect to guest home or login page
        header("Location: " . ROOT . "/guesthome");
        exit;
    }
}

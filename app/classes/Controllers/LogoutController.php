<?php


namespace App\Controllers;


use App\App;

class LogoutController
{
    public function logout()
    {
        App::$session->logout('/login');
    }

}
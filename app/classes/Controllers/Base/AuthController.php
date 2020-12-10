<?php


namespace App\Controllers\Base;


use App\App;

class AuthController
{
    protected string $redirect = '/login';

    public function __construct()
    {
        if (App::$session->getUser()['role'] !== 'admin'){
            header("Location: $this->redirect");
            exit();
        }
    }
}
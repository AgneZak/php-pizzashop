<?php


namespace App\Controllers;


use App\App;
use Core\FileDB;

class InstallController
{
    public function install()
    {
        App::$db = new FileDB(DB_FILE);

        App::$db->createTable('users');
        App::$db->insertRow('users', [
            'email' => 'test@test.lt',
            'password' => 'test',
            'name'=> 'test test',
            'role' => 'user'
        ]);
        App::$db->insertRow('users', [
            'email' => 'admin@test.lt',
            'password' => 'test',
            'name'=> 'Admin admin',
            'role' => 'admin'
        ]);

        App::$db->createTable('pizzas');
        App::$db->createTable('orders');
        App::$db->createTable('discounts');

    }

}
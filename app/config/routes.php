<?php

use Core\Router;

Router::add('index', '/', '\App\Controllers\HomeController');
Router::add('index2', '/index', '\App\Controllers\HomeController');

Router::add('login', '/login', '\App\Controllers\LoginController', 'login');
Router::add('register', '/register', '\App\Controllers\RegisterController', 'register');
Router::add('install', '/install', '\App\Controllers\InstallController', 'install');
Router::add('logout', '/logout', '\App\Controllers\LogoutController', 'logout');
Router::add('edit', '/edit', '\App\Controllers\Admin\EditController', 'edit');
Router::add('list', '/list', '\App\Controllers\Admin\ListController', 'editList');
Router::add('add', '/add', '\App\Controllers\Admin\AddController', 'add');
Router::add('admin_orders', '/admin/orders', '\App\Controllers\Admin\OrdersController');
Router::add('admin_users', '/admin/users', '\App\Controllers\Admin\UsersController');
Router::add('admin_discounts', '/admin/discounts', '\App\Controllers\Admin\Discount\ListController');
Router::add('admin_discounts_add', '/admin/discounts/add', '\App\Controllers\Admin\Discount\AddController');
Router::add('admin_discounts_edit', '/admin/discounts/edit', '\App\Controllers\Admin\Discount\EditController');

Router::add('user_orders', '/orders', '\App\Controllers\User\OrdersController');




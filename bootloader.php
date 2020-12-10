<?php

define('ROOT', __DIR__);
define('DB_FILE', ROOT . '/app/data/db.json');
date_default_timezone_set ('Europe/Vilnius');

require 'core/functions/html.php';
require 'core/functions/form/validators.php';

require 'app/functions/form/validators.php';
require 'app/classes/App.php';

require 'vendor/autoload.php';
require 'app/config/routes.php';





<?php

if(PHP_MAJOR_VERSION < 8) {
   die('Версия PHP меньше 8');
}

// Включаем отображение ошибок для отладки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/functions.php';
require_once CONFIG . '/routes.php';

new \shop\App();

//debug(\shop\Router::getRoutes());


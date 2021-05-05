<?php 

/* Основной файл проекта, который принимает все запросы пользователя (точка входа) */

//error_reporting (E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
define("FILES_ACCESS", true);

header("Content-Type:text/html; charset=utf-8");
session_start();

/* Подключение конфигураций */
require_once "configs.php";

/* Подключение роутера */
require_once $sitePath. DS. "components". DS ."Router.php";
require_once SITE_PATH . DS . "components" . DS . "DB.php";

$router = new Router;

$router->run();





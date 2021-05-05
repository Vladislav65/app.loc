<?php 

/* Файл констант проекта */

// проверка на прямой доступ к файлу
if(!defined("FILES_ACCESS")){
    exit("Прямой доступ закрыт");
}

//echo "configs.php";

define("DS", DIRECTORY_SEPARATOR);
//Задаём константу на путь к папке проекта
$sitePath = realpath(dirname(__FILE__) . DS);
define('SITE_PATH', $sitePath);


/* Конфигурация базы данных */
const DB_HOST = "localhost";
const DB_USER = "root";
const DP_PASSWORD = "root";
const DB_NAME = "app";





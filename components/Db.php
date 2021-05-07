<?php 
/* Класс, реализующий соединение с базой данных */

class Db{
    const DB_HOST = 'localhost';
    const DB_USER = 'mysql';
    const DB_PASS = 'mysql';
    const DB_NAME = 'app';

    private static $connection = NULL;

    public static function getConnection(){
        //$paramsPath = SITE_PATH . DS . "configs". DS . "DbParams.php";
        //$params = include($paramsPath);

        if(self::$connection == NULL){
            self::$connection = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
            if(mysqli_connect_errno()){
                throw new Exception("Ошибка соединения с базой данных: ".mysqli_connect_error());
            }
        }

        /*$connection = mysqli_connect($params['hostname'],
                                     $params['username'],
                                     $params['password'],
                                     $params['dbName']);*/

        return self::$connection;
    }

    private function __construct(){}
 
    private function __clone() {}
}
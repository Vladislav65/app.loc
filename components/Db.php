<?php 
/* Класс, реализующий соединение с базой данных */

class Db{

    public static function getConnection(){

        $paramsPath = SITE_PATH . DS . "configs". DS . "DbParams.php";
        $params = include($paramsPath);

        $connection = mysqli_connect($params['hostname'],
                                     $params['username'],
                                     $params['password'],
                                     $params['dbName']);

        return $connection;
    }
}
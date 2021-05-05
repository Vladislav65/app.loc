<?php

/** Модель обработки тестов */

class Tests{

    public static function getTests($courseId){

        $connection = Db::getConnection();
        $tests = [];

        $testsQuery = mysqli_query($connection, "SELECT * FROM tests
                                                          WHERE course_id = '$courseId'");
        
        while($testsAssoc = mysqli_fetch_assoc($testsQuery)){
            $tests[] = $testsAssoc;
        }

        return $tests;
    }
}
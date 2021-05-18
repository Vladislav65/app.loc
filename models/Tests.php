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

    public static function createTest($test, $courseId, $mentorId){
        $connection = Db::getConnection();
        $questionText = [];
        $questionAnswers = [];
        $corrects = [];
        $questions = [];
        $testNum = sizeof($test);

        $title = $test['testTitle'];

        foreach($test as $key => &$value){
            for($i = 1; $i <= 10; $i++){
                if($key == 'question' . $i){
                    array_push($questionText, $value);
                }
            }

            if(stripos($key, 'variant') !== false){
                array_push($questionAnswers, $value);
            }

            if(stripos($key, 'correct') !== false){
                array_push($corrects, $value);
            }
        }

        $questionAnswers = array_chunk($questionAnswers, 4);
        $questions = array_combine($questionText, $questionAnswers);
        $questions = json_encode($questions, JSON_FORCE_OBJECT);
        $corrects = json_encode($corrects, JSON_FORCE_OBJECT);

        $insertQuestionsQuery = mysqli_query($connection,
            "INSERT INTO tests(title, questions, answers, course_id)
                VALUES('$title', '$questions', '$corrects', '$courseId')");

        // после проверок
        return true;
    }

    public static function getTest($testId){
        $connection = Db::getConnection();
        $getTestQuery = mysqli_query($connection, "SELECT id, title, questions FROM tests
                                                            WHERE id = '$testId'");

        $testAssoc = mysqli_fetch_assoc($getTestQuery);
        $test['id'] = $testAssoc['id']; 
        $test['title'] = $testAssoc['title']; 
        $test['content'] = json_decode($testAssoc['questions'], true);

        return $test;
    }
}
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
            "INSERT INTO tests(title, questions, answers, course_id, status)
                VALUES('$title', '$questions', '$corrects', '$courseId', '{$test['testStatus']}')");

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

    public static function handleTest($studentId, $courseId, $testId, $test){
        $wrongs = 0;
        $result = 0;
        $connection = Db::getConnection();
        $getTestQuery = mysqli_query($connection, "SELECT * FROM tests
                                                            WHERE id = '$testId'");

        $testAssoc = mysqli_fetch_assoc($getTestQuery);
        $corrects = json_decode($testAssoc['answers'], true);
        $test = array_values($test);

        $wrongs = sizeof(array_diff_assoc($corrects, $test));
        $result = 10 - $wrongs;

        if($testAssoc['status'] == 'Итоговый'){
            if($result >= 7){
                $sertificateData = self::getDataForSertificate($studentId, $courseId, $result);
            }
        }
        exit;

        return $result;     
    }

    public static function getDataForSertificate($studentId, $courseId, $result){
        $connection = Db::getConnection();
        $courseGetQuery = mysqli_query($connection,
            "SELECT course_id, course_name, course_category, course_length, course_descr FROM courses WHERE course_id = '$courseId'");
    
        $courseAssoc = mysqli_fetch_assoc($courseGetQuery);

        
        /*echo "<pre>";
        var_dump($courseAssoc);
        echo "</pre>";*/
    }
}
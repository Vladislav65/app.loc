<?php

/** Класс-контроллер тестов */

include_once SITE_PATH . DS . "models" . DS . "Tests.php";
include_once SITE_PATH . DS . "models" . DS . "Admin.php";

class TestsController{

    public function actionDoTest($testId){
        $test = Tests::getTest($testId);
        $studentId = $_SESSION['student']['student_id']; 

        if(isset($_POST['dotest'])){
            $test = $_POST;
            unset($test['dotest']);

            $result = Tests::handleTest($studentId, $testId, $test);
            exit("<meta http-equiv='refresh' content='0; url= testResults{$result}'>");
        }

        require_once SITE_PATH . DS . "views" . DS . "test.php";

        return true;
    }

    public function actionGetResult($result){

        require_once SITE_PATH . DS . "views" . DS . "testResults.php";

        return true;
    }

    public function actionTestAdd($courseId){
        $test = $_POST;
        $mentorId = $_SESSION['mentor']['mentor_id'];

        if(isset($_POST['test'])){
            $result = Tests::createTest($test, $courseId, $mentorId);    
        }

        require_once SITE_PATH . DS . "views" . DS . "createTest.php";

        return true;
    }
}
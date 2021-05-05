<?php

/** Класс-контроллер тестов */

include_once SITE_PATH . DS . "models" . DS . "Tests.php";
include_once SITE_PATH . DS . "models" . DS . "Admin.php";

class TestsController{

    public function actionDoTest($testId){

        $test = Admin::getTest($testId);
        
        if(isset($_POST['dotest'])){
            $answer["answer1"] = $_POST['question1']; 
            $answer["answer2"] = $_POST['question2'];
            $answer["answer3"] = $_POST['question3'];

            $_SESSION['result'] = Admin::testAnalysis($testId, $answer);
            exit("<meta http-equiv='refresh' content='0; url= testResults'>");
        }

        require_once SITE_PATH . DS . "views" . DS . "test.php";

        return true;
    }

    public function actionGetResult(){

        require_once SITE_PATH . DS . "views" . DS . "testResults.php";
        return true;
    }
}
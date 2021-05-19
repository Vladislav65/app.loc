<?php

include_once SITE_PATH . DS . "models" . DS . "Courses.php";
include_once SITE_PATH . DS . "models" . DS . "Tests.php";

/* Контроллер курсов */

class CoursesController{

    public function actionIndex(){
        $coursesList = [];
        $coursesList = Courses::getCoursesList();

        require_once SITE_PATH . DS . "views" . DS . "courses.php";

        return true;
    }

    public function actionView($courseId){
        $course = Courses::getCourseItemById($courseId);

        require_once SITE_PATH . DS . "views" . DS . "course.php";
        
        return true;
    }

    public function actionStart($courseId){
        $studentId = $_SESSION['student']['student_id'];
        $topics = Courses::getTopics($courseId);
        $tests = Tests::getTests($courseId);
        $topicsNum = sizeof($topics);

        for($i = 0; $i < $topicsNum; $i++){
            if($topics[$i] == null){
                unset($topics[$i]);
            }
        }

        Courses::courseStart($courseId, $studentId);

        require_once SITE_PATH . DS . "views" . DS . "courseStarted.php";

        return true;
    }

    public function actionCourseAdd(){
        if(isset($_POST['courseAdd'])){
            $courseName = filter_var(trim($_POST['courseName']), FILTER_SANITIZE_STRING);
            $courseCategory = filter_var(trim($_POST['courseCategory']), FILTER_SANITIZE_STRING);
            $courseLength = filter_var(trim($_POST['length']), FILTER_SANITIZE_STRING);
            $courseDescr = filter_var(trim($_POST['descr']), FILTER_SANITIZE_STRING);
        }

        if($courseName != NULL &&
           $courseCategory != NULL &&
           $courseLength != NULL &&
           $courseDescr != NULL){

            $course = array(
                "courseName" => $courseName,
                "courseCategory" => $courseCategory,
                "courseLength" => $courseLength,
                "courseDescr" => $courseDescr
            );

            $courseAddResult = Courses::courseAdd($course);
        }

        require_once SITE_PATH . DS . "views" . DS . "courseAdd.php";

        return $courseAddResult;
    }
}
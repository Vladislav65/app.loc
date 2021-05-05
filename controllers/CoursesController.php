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

        Courses::courseStart($courseId, $studentId);

        require_once SITE_PATH . DS . "views" . DS . "courseStarted.php";

        return true;
    }
}
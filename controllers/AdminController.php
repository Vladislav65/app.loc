<?php

include_once SITE_PATH . DS . "models" . DS . "Admin.php";
include_once SITE_PATH . DS . "models" . DS . "User.php";
include_once SITE_PATH . DS . "models" . DS . "Courses.php";
include_once SITE_PATH . DS . "models" . DS . "Tests.php";

/* Класс-контроллер администратора */

class AdminController{

    public function actionIndex(){

        $statistics = Admin::statistics();

        require_once SITE_PATH . DS . "views" . DS . "admin.php";

        return true;
    }

    public function actionCourseAdd(){

        if(isset($_POST['courseAdd'])){
            $courseName = filter_var(trim($_POST['courseName']), FILTER_SANITIZE_STRING);
            $courseCategory = filter_var(trim($_POST['courseCategory']), FILTER_SANITIZE_STRING);
            $courseLength = filter_var(trim($_POST['length']), FILTER_SANITIZE_STRING);
            $courseDescr = filter_var(trim($_POST['descr']), FILTER_SANITIZE_STRING);
        }

        $courseImgPath = "templates/images/" . $_FILES['courseImage']['name'];

        if($courseName != NULL &&
           $courseCategory != NULL &&
           $courseLength != NULL &&
           $courseDescr != NULL){

            $course = array(
                "courseName" => $courseName,
                "courseImgPath" => $courseImgPath,
                "courseCategory" => $courseCategory,
                "courseLength" => $courseLength,
                "courseDescr" => $courseDescr
            );

            $courseAddResult = Admin::courseAdd($course);
        }

        require_once SITE_PATH . DS . "views" . DS . "courseAdd.php";

        return $courseAddResult;
    }

    public function actionUserControl(){

        $users = Admin::userControl();

        require_once SITE_PATH . DS . "views" . DS . "users.php";

        return true;
    }

    public function actionCoursesControl(){

        $coursesList = [];
        $coursesList = Courses::getCoursesList();

        require_once SITE_PATH . DS . "views" . DS . "courseControl.php";

        return true;
    }

    public function actionTopicAdd($courseId){

        if(isset($_POST['topicAdd'])){
            $topicTitle = filter_var(trim($_POST['topicTitle']), FILTER_SANITIZE_STRING);
            $topic = filter_var(trim($_POST['topic']), FILTER_SANITIZE_STRING);
        }

        $topicImgPath = "templates/images/" . $_FILES['topicImage']['name'];

        if($topicTitle != NULL && $topic != NULL){

            $topic = array(
                "topicTitle" => $topicTitle,
                "topicImgPath" => $topicImgPath,
                "topic" => $topic,
                "courseId" => $courseId
            );

            $topicAddResult = Admin::topicAdd($topic);
        }

        require_once SITE_PATH . DS . "views" . DS . "topicAdd.php";
        return true;
    }

    public function actionTestAdd($courseId){

        $test = $_POST;

        if(isset($_POST['test'])){
            $result = Admin::createTest($test, $courseId);    
        }

        require_once SITE_PATH . DS . "views" . DS . "createTest.php";
        return true;
    }

    public function actionCourseAdmin($courseId){
        $studentId = 0;

        $course = Courses::getCourseItemById($courseId);
        $topics = Courses::getTopics($courseId);
        $tests = Tests::getTests($courseId);

        Courses::courseStart($courseId, $studentId);
    
        require_once SITE_PATH . DS . "views" . DS . "courseAdmin.php";

        return true;
    }

    public function actionAddStudent(){

        $_SESSION['regErrorStack'] = [];

        if(isset($_POST['submit'])){
            $firstName = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
            $surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
            //$userStatus = filter_var(trim($_POST['userStatus']), FILTER_SANITIZE_STRING);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
            $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
            $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
            $confirmPassword = filter_var(trim($_POST['confirmPassword']), FILTER_SANITIZE_STRING);
        }

        $path = "templates/avatars/" . $_FILES['avatar']['name'];
        
        $registerData = array(
            "firstName" => $firstName,
            "surname" => $surname,
            //"userStatus" => $userStatus,
            "email" => $email,
            "avatarPath" => $path,
            "login" => $login,
            "password" => $password,
        );

        if($registerData['firstName'] != NULL &&
           $registerData['surname'] != NULL &&
           $registerData['login'] != NULL &&
           $registerData['password'] != NULL){

            if(mb_strlen($login) < 3){
                $_SESSION['regErrorStack'][] = "Недопустимая длина логина (< 3 символов)";
            }
    
            if(mb_strlen($password) < 3){
                $_SESSION['regErrorStack'][] = "Недопустимая длина пароля (< 3 символов)";
            }
    
            if($login == $password){
                $_SESSION['regErrorStack'][] = "Ошибка! Логин и пароль совпадают";
            }
    
            if($password != $confirmPassword){
                $_SESSION['regErrorStack'][] = "Ошибка! Введённые пароли не совпадают";
            }

            if($_SESSION['regErrorStack'] == NULL){
                $flag = User::register($registerData);
            }

            if($flag == false){
                $_SESSION['regErrorStack'][] = "Пользователь с таким логином уже зарегистрирован";
            }
        }
        
        require_once SITE_PATH . DS . "views" . DS . "studentAdd.php";

        return true;
    }

    public function actionGraph(){

        $information = Admin::graph();
        $counters = [];

        $counters = [
            "Основы экономики" => 0,
            "Микроэкономика" => 0,
            "Макроэкономика" => 0,
            "Мировая экономика" => 0,
            "Основы логистики" => 0,
            "Закупочная логистика" => 0,
            "Сбытовая логистика" => 0,
            "Транспортная логистика" => 0,
            "Таможенная логистика" => 0,
            "Логистика запасов" => 0,
            "Информационная логистика" => 0,
            "Комплексная логистика" => 0
        ];

        // Разобраться, возможно ли вывести в код диаграммы массив js

        foreach($information["addSpecInfo"] as $elem){
            switch($elem){
                case "Основы экономики":
                    $counters["Основы экономики"]++;
                break;

                case "Микроэкономика":
                    $counters["Микроэкономика"]++;
                break;

                case "Макроэкономика":
                    $counters["Макроэкономика"]++;
                break;

                case "Мировая экономика":
                    $counters["Мировая экономика"]++;
                break;

                case "Основы логистики":
                    $counters["Основы логистики"]++;
                break;

                case "Закупочная логистика":
                    $counters["Закупочная логистика"]++;
                break;

                case "Сбытовая логистика":
                    $counters["Сбытовая логистика"]++;
                break;

                case "Транспортная логистика":
                    $counters["Транспортная логистика"]++;
                break;

                case "Таможенная логистика":
                    $counters["Таможенная логистика"]++;
                break;

                case "Логистика запасов":
                    $counters["Логистика запасов"]++;
                break;

                case "Информационная логистика":
                    $counters["Информационная логистика"]++;
                break;

                case "Комплексная логистика":
                    $counters["Комплексная логистика"]++;
                break;
            }
        }  

        require_once SITE_PATH . DS . "views" . DS . "graph.php";

        return true;
    }

    public function actionSaveFile(){
        
        $fileResult = Admin::saveToFile();

        require_once SITE_PATH . DS . "views" . DS . "admin.php";

        return true;
    }

    public function actionDeleteCourse($courseId){
        
        $result = Admin::deleteCourse($courseId);
        exit("<meta http-equiv='refresh' content='0; url= coursecontrol'>");
    }

    public function actionDeleteStudent($studentId){
        
        $result = Admin::deleteStudent($studentId);
        exit("<meta http-equiv='refresh' content='0; url= usercontrol'>");
    }

    public function actionDeleteMentor($mentorId){
        
        $result = Admin::deleteMentor($mentorId);
        exit("<meta http-equiv='refresh' content='0; url= usercontrol'>");
    }
}
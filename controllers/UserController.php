<?php

include_once SITE_PATH . DS . "models" . DS . "User.php";

/* Класс-контроллер, работающий с операциями пользователей */

class UserController{

    public $mentorId;

    public function actionRegister(){

        $_SESSION['regErrorStack'] = [];

        if(isset($_POST['submit'])){
            $status = $_POST['status'];
            $firstName = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
            $surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
            $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
            $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
            $confirmPassword = filter_var(trim($_POST['confirmPassword']), FILTER_SANITIZE_STRING);
        }

        $path = "templates/avatars/" . $_FILES['avatar']['name'];
        
        $registerData = array(
            "firstName" => $firstName,
            "surname" => $surname,
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
                if($status == 'student'){
                    $flag = User::register($registerData);
                }else{
                    echo $flag = User::mentorRegister($registerData);
                    $this->mentorId = $flag;
                    exit("<meta http-equiv='refresh' content='0; url= userMR'>");
                }
            }

            if($flag == false){
                $_SESSION['regErrorStack'][] = "Пользователь с таким логином уже зарегистрирован";
            }
        }

        require_once SITE_PATH . DS . "views" . DS . "registration.php";

        return true;
    }

    public function actionMentorReg(){

        if(isset($_POST['mentorReg'])){
            $addRegData = $_POST; 
            unset($addRegData['mentorReg']);
            
            $flag = User::addMentorReg($addRegData);
            if($flag == true){
                exit("<meta http-equiv='refresh' content='0; url= /'>");
            }
        }
        
        require_once SITE_PATH . DS . "views" . DS . "mentorReg.php";

        return true;
    }

    public function actionAuth(){

        $authFlag = true;

        if(isset($_POST['auth'])){
            $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
            $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
            //$userStatus = filter_var(trim($_POST['userStatus']), FILTER_SANITIZE_STRING);
            $adminCheck = $_POST['adminCheck'];
        }

        if(isset($adminCheck)){

            $adminFlag = User::adminControl($login, $password);

            if($adminFlag == false){
                exit("<meta http-equiv='refresh' content='0; url= userA'>");
            }else{
                exit("<meta http-equiv='refresh' content='0; url= admin'>");
            }
        }else{
            if($login != NULL && $password != NULL){

                $authFlag = User::auth($login, $password);

                if($authFlag == false){
                    // exit ниже можно не писать
                    exit("<meta http-equiv='refresh' content='0; url= userA'>");
                }else if($authFlag === 'mentor_true'){
                    exit("<meta http-equiv='refresh' content='0; url= mentorM'>");
                }else if($authFlag === true){
                    // Разобраться с выходом
                    exit("<meta http-equiv='refresh' content='0; url= student'>");
                    //header("Location: student");
                }
            }
        }
        
        require_once SITE_PATH . DS . "views" . DS . "auth.php";

        return true;
    }

    public function actionLogout(){

        unset($_SESSION["student"]);
        unset($_SESSION["mentor"]);
        exit("<meta http-equiv='refresh' content='0; url= /'>");
        //header("Location: /");
    }

    public function actionLogoutA(){

        unset($_SESSION["admin"]);
        exit("<meta http-equiv='refresh' content='0; url= /'>");
        //header("Location: /");
    }
}
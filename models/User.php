<?php

/* Модель пользователя */

class User{

    public static function register($registerBuf){

        $connection = Db::getConnection();

        $registerData = $registerBuf;
        $loginCheckArray = [];

        $firstName = $registerData['firstName'];
        $surname = $registerData['surname'];
        //$userStatus = $registerData['userStatus'];
        $email = $registerData['email'];
        $avatarPath = $registerData['avatarPath'];
        $login = $registerData['login'];
        $password = $registerData['password'];

        $loginCheckQuery = mysqli_query($connection,
        "SELECT * FROM students WHERE student_login = '$login'");

        while($loginCheck = mysqli_fetch_assoc($loginCheckQuery)){
            $loginCheckArray[] = $loginCheck;
        }

        $loginCheckQuery1 = mysqli_query($connection,
        "SELECT * FROM mentors WHERE mentor_login = '$login'");

        while($loginCheck = mysqli_fetch_assoc($loginCheckQuery1)){
            $loginCheckArray1[] = $loginCheck;
        }

        if($loginCheckArray != NULL || $loginCheckArray1 != NULL){  
            return false;
            exit();
        }else{
            // Хэширование пароля
            $hash = password_hash($password, PASSWORD_BCRYPT);

            // Если пользователь не добавил фото, добавится пустой аватар
            $avatarArr = explode("/", $avatarPath);

            if($avatarArr[2] == ""){
                $avatarArr[2] = "empty.jpg";
                $avatarPath = implode("/", $avatarArr);
            }

            if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarPath)){
                $_SESSION['avatarError'] = "Не удалось загрузить фото. Попробуйте загрузить его из профиля";
            }

            $studentRegQuery = mysqli_query($connection,
            "INSERT INTO students (student_first_name,
                                   student_surname,
                                   student_email,
                                   student_avatar,
                                   student_login,
                                   student_hash)
             VALUES ('$firstName',
                     '$surname',
                     '$email',
                     '$avatarPath',
                     '$login',
                     '$hash')");        

            return true;
        }
    }

    public static function mentorRegister($registerData){
        $connection = Db::getConnection();

        $loginCheckQuery = mysqli_query($connection,
        "SELECT * FROM mentors WHERE mentor_login = '{$registerData['login']}'");

        while($loginCheck = mysqli_fetch_assoc($loginCheckQuery)){
            $loginCheckArray[] = $loginCheck;
        }

        if($loginCheckArray != NULL){  
            return false;
            exit();
        }else{
            // Хэширование пароля
            $hash = password_hash($registerData['password'], PASSWORD_BCRYPT);

            // Если пользователь не добавил фото, добавится пустой аватар
            $avatarArr = explode("/", $registerData['avatarPath']);

            if($avatarArr[2] == ""){
                $avatarArr[2] = "empty.jpg";
                $registerData['avatarPath'] = implode("/", $avatarArr);
            }

            if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $registerData['avatarPath'])){
                $_SESSION['avatarError'] = "Не удалось загрузить фото. Попробуйте загрузить его из профиля";
            }

            $mentorRegQuery = mysqli_query($connection,
            "INSERT INTO mentors (mentor_first_name,
                                  mentor_surname,
                                  mentor_email,
                                  mentor_avatar,
                                  mentor_login,
                                  mentor_hash,
                                  speciality,
                                  add_speciality,
                                  experience,
                                  rating,
                                  graduation,
                                  format,
                                  days,
                                  age)
             VALUES ('{$registerData['firstName']}',
                     '{$registerData['surname']}',
                     '{$registerData['email']}',
                     '{$registerData['avatarPath']}',
                     '{$registerData['login']}',
                     '$hash',
                     '-',
                     '-',
                     '0',
                     '0',
                     '-',
                     '-',
                     '-',
                     '0')");        

            $mentorId = mysqli_insert_id($connection);

            return $mentorId;
        }
    }

    public static function addMentorReg($addRegData){

        $connection = DB::getConnection();

        $mentorIdQuery = mysqli_query($connection,
            "SELECT mentor_id FROM mentors ORDER BY mentor_id DESC");

            $mentorIdAssoc = mysqli_fetch_assoc($mentorIdQuery);
            if($mentorIdAssoc == NULL){
                $mentorId = 1;
            }else{
                $mentorId = $mentorIdAssoc['mentor_id'];
            }
            
            if($addRegData['speciality'] == 'economics'){
                unset($addRegData['lDirections']);
                $addRegData['add_speciality'] = $addRegData['eDirections'];
                unset($addRegData['eDirections']);
            }else if($addRegData['speciality'] == 'logistics'){
                unset($addRegData['eDirections']);
                $addRegData['add_speciality'] = $addRegData['lDirections'];
                unset($addRegData['lDirections']);
            }

            $format = implode('-', $addRegData['format']);
            $days = implode(',', $addRegData['days']);

            $updateMentorQuery = mysqli_query($connection,
                "UPDATE mentors SET
                speciality = '{$addRegData['speciality']}',
                add_speciality = '{$addRegData['add_speciality']}',
                experience = '{$addRegData['experience']}',
                graduation = '{$addRegData['graduation']}',
                format = '{$format}',
                days = '{$days}',
                age = '{$addRegData['age']}'
                WHERE mentor_id = '{$mentorId}'");

            return true;
    }

    public static function auth($log, $pass){

        $login = $log;
        $password = $pass;

        $connection = DB::getConnection();

        $authQuery = mysqli_query($connection, 
            "SELECT * FROM students WHERE student_login = '$login'");

        $authArray = mysqli_fetch_assoc($authQuery);
        $hash = $authArray['student_hash'];

        if(!(password_verify($password, $hash))){
            $result = self::mentorAuth($login, $password);
            if($result == false){
                $_SESSION['authErrorStack'] = "Неверный логин или (и) пароль";
                return false;
            }else{
                return 'mentor_true';
            }
        }else{
            $_SESSION['student'] = array(
                'student_id' => $authArray['student_id'],
                'student_first_name' => $authArray['student_first_name'],
                'student_surname' => $authArray['student_surname'],
                'student_email' => $authArray['student_email'],
                'student_avatar' => $authArray['student_avatar'],
                'student_login' => $authArray['student_login'],
                'student_password' => $password
            );

            return true;
        }
    }

    public static function mentorAuth($login, $password){

        $connection = Db::getConnection();

        $authQuery = mysqli_query($connection, 
            "SELECT * FROM mentors WHERE mentor_login = '$login'");

        $authArray = mysqli_fetch_assoc($authQuery);
        $hash = $authArray['mentor_hash'];
        
        if(!(password_verify($password, $hash))){
            $_SESSION['authErrorStack'] = "Неверный логин или (и) пароль";
            return false;
        }else{
            $_SESSION['mentor'] = [
                'mentor_id' => $authArray['mentor_id'],
                'mentor_first_name' => $authArray['mentor_first_name'],
                'mentor_surname' => $authArray['mentor_surname'],
                'mentor_email' => $authArray['mentor_email'],
                'mentor_avatar' => $authArray['mentor_avatar'],
                'mentor_login' => $authArray['mentor_login'],
                //'mentor_password' => $password
                'speciality' => $authArray['speciality'],
                'add_speciality' => $authArray['add_speciality'],
                'experience' => $authArray['experience'],
                'rating' => $authArray['rating'],
                'graduation' => $authArray['graduation'],
                'format' => $authArray['format'],
                'days' => $authArray['days'],
                'age' => $authArray['age']
            ];

            return 'mentor_true';
        }
    }

    public static function adminControl($login, $password){

        $connection = Db::getConnection();

        $adminAuthQuery = mysqli_query($connection, "SELECT * FROM admin
                                                     WHERE login = '$login' AND password = '$password'");
        $adminAuthResult = mysqli_fetch_assoc($adminAuthQuery);
        
        if($adminAuthResult == NULL){
            $_SESSION['authErrorStack'] = "Неверный логин или (и) пароль";
            return false;
        }else{
            $_SESSION['admin'] = array(
                ["id"] => $adminAuthResult["id"],
                ["login"] => $adminAuthResult["login"],
                ["password"] => $adminAuthResult["password"],
                ["status"] => $adminAuthResult["status"]                
            );

            return true;
        }
    }

    public static function isLogged(){
        
        if(isset($_SESSION['student']) || isset($_SESSION['mentor'])){
            return true;
        }else{
            return false;
        }
    }

    public static function adminIsLogged(){
        
        if(isset($_SESSION['admin'])){
            return true;
        }else{
            return false;
        }
    }
}
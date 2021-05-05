<?php

/* Разобраться, как записать $connection 1 раз (возм. конструктор) */

class Mentors{

    public static function getMentorById($id){

        $connection = Db::getConnection();

        $getMentorQuery = mysqli_query($connection, "SELECT * FROM mentors WHERE mentor_id = '$id'");
        $mentor = mysqli_fetch_assoc($getMentorQuery);

        return $mentor;
    }   

    public static function getRecommendedMentors($idS){

        $connection = Db::getConnection();

        $topMentors = [];
        // Выбираем 3 элемента через 1 where
        for($i = 0; $i < 3; $i++){
            $getMentorQuery = mysqli_query($connection, "SELECT * FROM mentors WHERE mentor_id = '$idS[$i]'");
            $topMentors[] = mysqli_fetch_assoc($getMentorQuery);
        }

        return $topMentors;
    }
    
    public static function getMentorsList(){

        $connection = Db::getConnection();

        $mentorsList = [];
        $mentorsListQuery = mysqli_query($connection, "SELECT * FROM mentors");

        while($mentorsBuf = mysqli_fetch_assoc($mentorsListQuery)){
            $mentorsList[] = $mentorsBuf;
        }

        return $mentorsList;
    }

    // Функция определения подходящих менторов
    public static function mentorTest($mentorTestArray){

        $connection = Db::getConnection();
        $idS = [];

        // массив, в который записываются менторы, которые категорически не подходят
        $idNotSuitable = [];
        $mentorData = $mentorTestArray;

        $mentorSelectQuery = mysqli_query($connection,
        "SELECT mentor_id, speciality, add_speciality, experience, rating, graduation, format, days, age FROM mentors");
        
        while($mentorBuf = mysqli_fetch_assoc($mentorSelectQuery)){
            $mentorDbArray[] = $mentorBuf; 
        }

        // Запрос сравнивается с результатами из БД и id записываются в массив. 
        // Ментор с наибольшим совпадением id является рекомендуемым  
        foreach($mentorDbArray as $mentorDb){

            if($mentorDb["speciality"] == $mentorData["sphere"]){
                $idS[] = $mentorDb["mentor_id"];
                // Студенту подходят только менторы его основной специальности
            }else{
                $idNotSuitable[] = $mentorDb["mentor_id"]; 
            }   

            if($mentorDb["add_speciality"] == $mentorData["add"]){
                $idS[] = $mentorDb["mentor_id"];
            }

            if(Mentors::checkExperience($mentorData["experience"],
                                        $mentorDb["experience"]) == true){
                $idS[] = $mentorDb["mentor_id"];               
            }
            
            // Если опыт студента больше опыта ментора, то ментор категорически не подходит
            if($mentorData["experience"] > $mentorDb["experience"]){
                $idNotSuitable[] = $mentorDb["mentor_id"];
            }

            if($mentorDb["graduation"] == $mentorData["graduation"]){
                $idS[] = $mentorDb["mentor_id"];
            } 

            // проверяем формат занятий (дистанционное-очное)
            if(Mentors::checkFormat($mentorData["format"], $mentorDb["format"]) == true){
                $idS[] = $mentorDb["mentor_id"];
            }

            // проверяем дни занятий
            if(Mentors::checkDays($mentorData["days"], $mentorDb["days"]) == true){
                $idS[] = $mentorDb["mentor_id"];
            }

            // проверяем возраст в диапазоне
            if(Mentors::checkAge($mentorData["age"], $mentorDb["age"]) == true){
                $idS[] = $mentorDb["mentor_id"];
            }

            // проверяем рейтинг
            if(Mentors::checkRating($mentorData["rating"], $mentorDb["rating"]) == true){
                $idS[] = $mentorDb["mentor_id"];
            }
        }

        // алгоритм сортирует по частоте
        $idBuf = array_count_values($idS);
        arsort($idBuf);
        $sorted = array_slice(array_keys($idBuf), 0, 10, true);

        // Исключить из массива элементы из not suitable
        $recommended = array_diff($sorted, $idNotSuitable);
        
        if(sizeof($recommended) == 0){
            $recommended[0] = "В данный момент на портале нет подходящих менторов";
        }   

        return $recommended;
    }

    public static function checkExperience($expBuf, $expDbBuf){

        $flag = false;
        $difference = $expDbBuf - $expBuf;

        if($difference > 3){
            $flag = true;
        }

        return $flag;
    }

    public static function checkFormat($formatBuf, $formatDbBuf){

        $flag = false;
        $formatDb = explode("-", $formatDbBuf);
        $formatCommon = array_intersect($formatBuf, $formatDb);

        if(sizeof($formatCommon) != 0){
            $flag = true; 
        }

        return $flag;
    }

    public static function checkDays($daysBuf, $daysDbBuf){

        $flag = false;
        $daysDb = explode(",", $daysDbBuf);
        $daysCommon = array_intersect($daysBuf, $daysDb);

        if(sizeof($daysCommon) != 0){
            $flag = true; 
        }

        return $flag;
    }

    // проверяем возраст в диапазоне
    public static function checkAge($ageBuf, $ageDb){

        $flag = false;

        if($ageBuf != "50 и старше"){
            $age = explode("-", $ageBuf);
        
            for($i = $age[0]; $i <= $age[1]; $i++){
                if($ageDb == $i){
                    $flag = true;
                }
            }            
        }else{
            if($ageDb > 50){
                $flag = true;
            }
        }

        return $flag;
    }

    public static function checkRating($rateBuf, $rateDbBuf){

        $flag = false;
        $difference = $rateDbBuf - $rateBuf;

        if(!($difference > 10 || $difference < -10)){
            $flag = true;
        }

        return $flag;
    }

    public static function createGroup($groupInfo){
        $connection = Db::getConnection();
        $ownerId = $_SESSION['mentor']['mentor_id'];

        $mentorNameQuery = mysqli_query($connection,
        "SELECT mentor_first_name, mentor_surname FROM mentors WHERE mentor_id = '$ownerId'");
        $mentorInfo = mysqli_fetch_assoc($mentorNameQuery);

        $groupAddQuery = mysqli_query($connection, "INSERT INTO groups (owner,
                                                                        owner_name,
                                                                        owner_surname,
                                                                        name,
                                                                        speciality,
                                                                        add_speciality,
                                                                        status)
                                                    VALUES ('$ownerId',
                                                            '{$mentorInfo['mentor_first_name']}',
                                                            '{$mentorInfo['mentor_surname']}',
                                                            '{$groupInfo['groupName']}',
                                                            '{$groupInfo['speciality']}',
                                                            '{$groupInfo['add_speciality']}',
                                                            '{$groupInfo['status']}')");

        return true;                                                    
    }  

    public static function getGroups(){
        $connection = Db::getConnection();
        $ownerId = $_SESSION['mentor']['mentor_id'];
        $groups = [];

        $groupsQuery = mysqli_query($connection,
        "SELECT * FROM groups WHERE owner='$ownerId'");

        while($groupsAssoc = mysqli_fetch_assoc($groupsQuery)){
            $groups[] = $groupsAssoc;
        }

        if(!empty($groups)){
            return $groups;
        }else{
            return false;
        }
    }

    public static function getStudents(){
        $connection = Db::getConnection();
        $studentsList = [];

        $studentsQuery = mysqli_query($connection,
            "SELECT student_id, student_first_name, student_surname, student_email, student_avatar,
            student_login FROM students");

        while($studentsAssoc = mysqli_fetch_assoc($studentsQuery)){
            $studentsList[] = $studentsAssoc;        
        }

        if(!empty($studentsList)){
            return $studentsList;
        }else{
            return false;
        }
    }

    public static function sendInvitation($groupId, $studentId){

        $connection = Db::getConnection();
        $mentorId = $_SESSION['mentor']['mentor_id'];

        $selectInvitationQuery = mysqli_query($connection,
        "SELECT * FROM invitations WHERE mentor_id = '$mentorId' AND
                                         student_id = '$studentId' AND
                                         group_id = '$groupId'");
        
        $selectInvitationAssoc = mysqli_fetch_assoc($selectInvitationQuery);

        if($selectInvitationAssoc != NULL){
            if($selectInvitationAssoc['status'] == 'sent'){
                $result = 'Приглашение уже был отправлено ранее';
                return $result;
            }else if($selectInvitationAssoc['status'] == 'accepted'){
                $result = 'Приглашение уже было принято студентом';
                return $result;
            }
        }else{
            $invitationQuery = mysqli_query($connection,
            "INSERT INTO invitations(mentor_id, student_id, group_id)
            VALUES('$mentorId', '$studentId', '$groupId')");

            $result = 'Приглашение отправлено';

            return $result;
        } 
    }
}
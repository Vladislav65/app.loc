<?php

/** Класс-модель администратора */

class Admin{

    public static function statistics(){
        $connection = Db::getConnection();

        $statistics = [];

        $getStudentsNum = mysqli_query($connection, "SELECT * FROM students");
        $statistics["studentsNum"] = mysqli_num_rows($getStudentsNum);

        $getMentorsNum = mysqli_query($connection, "SELECT * FROM mentors");
        $statistics["mentorsNum"] = mysqli_num_rows($getMentorsNum);

        $getCoursesNum = mysqli_query($connection, "SELECT * FROM courses");
        $statistics["coursesNum"] = mysqli_num_rows($getCoursesNum);

        $getTopicsNum = mysqli_query($connection, "SELECT * FROM topics");
        $statistics["topicsNum"] = mysqli_num_rows($getTopicsNum);

        $getTestsNum = mysqli_query($connection, "SELECT * FROM tests");
        $statistics["testsNum"] = mysqli_num_rows($getTestsNum);
        
        // Разобраться, как создать запрос, чтобы достать только 3 первых значения
        $ratedMentorsQuery = mysqli_query($connection, "SELECT mentor_first_name, mentor_surname FROM mentors ORDER BY rating DESC");
        
        while($ratedAssoc = mysqli_fetch_assoc($ratedMentorsQuery)){
            $statistics["ratedMentors"][] = $ratedAssoc;
        }

        $statistics["ratedMentors"] = array_slice($statistics["ratedMentors"], 0, 3);

        return $statistics;
    }

    public static function saveToFile(){
        $statistics = [];
        $statisticsBuf = self::statistics();
        $filepath = SITE_PATH . DS . "templates" . DS . "files" . DS . "statistics.txt";

        foreach($statisticsBuf as $elem){
            $statistics["Количество студентов:"] = $statisticsBuf["studentsNum"];
            $statistics["Количество менторов:"] = $statisticsBuf["mentorsNum"];    
            $statistics["Количество курсов:"] = $statisticsBuf["coursesNum"];     
            $statistics["Количество тем:"] = $statisticsBuf["topicsNum"];
        }

        date_default_timezone_set('Europe/Minsk');
        $date = date('d/m/Y h:i:s a', time());

        $jsonStats = "Дата записи:" . $date . " " .
        json_encode($statistics, JSON_UNESCAPED_UNICODE);

        try{
            if(!($file = fopen($filepath, "w"))){
                throw new Exception("Ошибка, файл не открыт");
            }
            $writeStats = file_put_contents($filepath, $jsonStats);

            fclose($file);

            return "Запись в файл прошла успешно";
        }catch(Exception $e){
            echo $e->getMessage();
        };
    }

    public static function userControl(){
        $connection = Db::getConnection();
        $users = array(
            "students" => [],
            "mentors" => []
        );

        $getStudentsQuery = mysqli_query($connection, "SELECT * FROM students");
        while($studentsAssoc = mysqli_fetch_assoc($getStudentsQuery)){
            $users["students"][] = $studentsAssoc;
        }

        $getMentorsQuery = mysqli_query($connection, "SELECT * FROM mentors");
        while($mentorsAssoc = mysqli_fetch_assoc($getMentorsQuery)){
            $users["mentors"][] = $mentorsAssoc;
        }

        return $users;
    }

    public static function graph(){
        $connection = Db::getConnection();
        $information = [];

        $addSpecQuery = mysqli_query($connection, "SELECT add_speciality FROM mentors");
        while($addSpecAssoc = mysqli_fetch_assoc($addSpecQuery)){
            $information["addSpecInfo"][] = current($addSpecAssoc); 
        }

        $usersQuery = mysqli_query($connection,
        "SELECT 
                (SELECT COUNT(*) FROM students) AS sCount, 
                (SELECT COUNT(*) FROM mentors) AS mCount");

        while($fetchUsers = mysqli_fetch_row($usersQuery)){
            $information["usersNum"]["Количество студентов"] = $fetchUsers[0];
            $information["usersNum"]["Количество менторов"] = $fetchUsers[1];
        }

        //$jsonInfo = json_encode($information, JSON_UNESCAPED_UNICODE);

        return $information;
    }

    public static function deleteCourse($id){
        $connection = Db::getConnection();
        $courseDelQuery = mysqli_query($connection, "DELETE FROM courses WHERE course_id = '$id'");

        return true;
    }

    public static function deleteStudent($id){
        $connection = Db::getConnection();
        $studentDelQuery = mysqli_query($connection, "DELETE FROM students WHERE student_id = '$id'");

        return true;
    }

    public static function deleteMentor($id){
        $connection = Db::getConnection();
        $mentorDelQuery = mysqli_query($connection, "DELETE FROM mentors WHERE mentor_id = '$id'");

        return true;
    }
}
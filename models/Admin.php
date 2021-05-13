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

    public static function topicAdd($topic){
        $connection = Db::getConnection();

        $topicImgPath = $topic["topicImgPath"];
        $topicTitle = $topic["topicTitle"];
        $topicContent = $topic["topic"];
        $courseId = $topic["courseId"];

        $topicImgArr = explode("/", $topicImgPath);
        if($topicImgArr[2] == ""){
            $topicImgArr[2] = "noImg.jpg";
            $topicImgPath = implode("/", $topicImgArr);
        }

        if(!move_uploaded_file($_FILES['topicImage']['tmp_name'], $topicImgPath)){
                $_SESSION['avatarError'] = "Не удалось загрузить фото. Попробуйте загрузить его из профиля";
        }

        $topicAddQuery = mysqli_query($connection, "INSERT INTO topics (
                                                                    topic_title,
                                                                    topic_img,
                                                                    topic_content,
                                                                    course_id)
                                                     VALUES ('$topicTitle',
                                                                    '$topicImgPath',
                                                                    '$topicContent',
                                                                    '$courseId')");
        
        return $topicAddResult = "Тема была успешно добавлена";
    }

    public static function createTest($test, $courseId){

        $connection = Db::getConnection();

        /** Запись теста в БД */

        $testTitle = $test['testTitle'];
        $question1 = $test['question1'] . ";" .
                     $test['variant11'] . ";" .
                     $test['variant12'] . ";" .
                     $test['variant13'] . ";" .
                     $test['variant14'];
        
        $question2 = $test['question2'] . ";" .
                     $test['variant21'] . ";" .
                     $test['variant22'] . ";" .
                     $test['variant23'] . ";" .
                     $test['variant24'];  
        
        $question3 = $test['question3'] . ";" .
                     $test['variant31'] . ";" .
                     $test['variant32'] . ";" .
                     $test['variant33'] . ";" .
                     $test['variant34'];    
                          
        $addTestQuery = mysqli_query($connection, "INSERT INTO tests(course_id,
                                                                     test_title,
                                                                     question1,
                                                                     question2,
                                                                     question3)
                                                    VALUES('$courseId',
                                                           '$testTitle',
                                                           '$question1',
                                                           '$question2',
                                                           '$question3')");
        $testId = mysqli_insert_id($connection);

        /** Запись правильных ответов */
        $correct1 = "variant1" . $test['correct1'];
        $correct2 = "variant2" . $test['correct2'];
        $correct3 = "variant3" . $test['correct3'];

        foreach($test as $key => $value){
            if($correct1 == $key){
                $answer1 = $value;
            }

            if($correct2 == $key){
                $answer2 = $value;
            }

            if($correct3 == $key){
                $answer3 = $value;
            }
        }

        $addAnswersQuery = mysqli_query($connection, "INSERT INTO answers(test_id,
                                                                          answer1,
                                                                          answer2,
                                                                          answer3)
                                                      VALUES('$testId',
                                                             '$answer1',
                                                             '$answer2',
                                                             '$answer3')");

        /*echo "<pre>";
        var_dump($addAnswersQuery);
        echo "</pre>";*/
        
        if($addAnswersQuery != NULL && $addTestQuery != NULL){
            return "Тест был успешно добавлен";
        }else{
            return "Ошибка добавления теста";
        }
    }

    public static function getTest($testId){
        
        $connection = Db::getConnection();
        $getTestQuery = mysqli_query($connection, "SELECT * FROM tests
                                                            WHERE test_id = '$testId'");

        $test = mysqli_fetch_assoc($getTestQuery);

        foreach($test as $key => $value){
            switch($key){
                case "question1":
                    $question1 = explode(";", $value);
                break;

                case "question2":
                    $question2 = explode(";", $value);
                break;

                case "question3":
                    $question3 = explode(";", $value);
                break;
            }
        }
        $test["content"] = array_merge($question1, $question2, $question3);
        unset($test["question1"]);
        unset($test["question2"]);
        unset($test["question3"]);

        return $test;
    }

    public static function testAnalysis($testId, $answer){
        
        $connection = Db::getConnection();

        $getAnswersQuery = mysqli_query($connection, "SELECT answer1, answer2, answer3 FROM answers
                                                      WHERE test_id = '$testId'");
        
        $corrects = mysqli_fetch_assoc($getAnswersQuery);
        
        $cnt = 0;
        foreach($corrects as $corr){
            foreach($answer as $ans){
                if($corr == $ans){
                    $cnt++;
                }
            }
        }

        return $cnt;
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
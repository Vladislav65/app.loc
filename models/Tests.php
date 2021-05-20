<?php

/** Модель обработки тестов */

class Tests{

    public static $groupId;

    public static function getTests($courseId){
        $connection = Db::getConnection();
        $tests = [];

        $testsQuery = mysqli_query($connection, "SELECT * FROM tests
                                                          WHERE course_id = '$courseId'");
        
        while($testsAssoc = mysqli_fetch_assoc($testsQuery)){
            $tests[] = $testsAssoc;
        }

        return $tests;
    }

    public static function createTest($test, $courseId, $mentorId){
        $connection = Db::getConnection();
        $questionText = [];
        $questionAnswers = [];
        $corrects = [];
        $questions = [];
        $testNum = sizeof($test);

        $title = $test['testTitle'];

        foreach($test as $key => &$value){
            for($i = 1; $i <= 10; $i++){
                if($key == 'question' . $i){
                    array_push($questionText, $value);
                }
            }

            if(stripos($key, 'variant') !== false){
                array_push($questionAnswers, $value);
            }

            if(stripos($key, 'correct') !== false){
                array_push($corrects, $value);
            }
        }

        $questionAnswers = array_chunk($questionAnswers, 4);
        $questions = array_combine($questionText, $questionAnswers);
        $questions = json_encode($questions, JSON_FORCE_OBJECT);
        $corrects = json_encode($corrects, JSON_FORCE_OBJECT);

        $insertQuestionsQuery = mysqli_query($connection,
            "INSERT INTO tests(title, questions, answers, course_id, status)
                VALUES('$title', '$questions', '$corrects', '$courseId', '{$test['testStatus']}')");

        // после проверок
        return true;
    }

    public static function getTest($testId){
        $connection = Db::getConnection();
        $getTestQuery = mysqli_query($connection, "SELECT id, title, questions FROM tests
                                                            WHERE id = '$testId'");

        $testAssoc = mysqli_fetch_assoc($getTestQuery);
        $test['id'] = $testAssoc['id']; 
        $test['title'] = $testAssoc['title']; 
        $test['content'] = json_decode($testAssoc['questions'], true);

        return $test;
    }

    public static function handleTest($studentId, $courseId, $testId, $test){
        $wrongs = 0;
        $result = 0;
        $connection = Db::getConnection();
        $getTestQuery = mysqli_query($connection, "SELECT * FROM tests
                                                            WHERE id = '$testId'");

        $testAssoc = mysqli_fetch_assoc($getTestQuery);
        $corrects = json_decode($testAssoc['answers'], true);
        $test = array_values($test);

        $wrongs = sizeof(array_diff_assoc($corrects, $test));
        $result = 10 - $wrongs;

        if($testAssoc['status'] == 'Итоговый'){
            if($result >= 7){
                $sertificateData = self::getDataForSertificate($studentId, $courseId, $result);
                self::createSertificate($sertificateData);
            }
        }
        exit;

        return $result;     
    }

    public static function getDataForSertificate($studentId, $courseId, $result){
        $sertificateData = [];
        $connection = Db::getConnection();
        $studentGetQuery = mysqli_query($connection,
            "SELECT student_first_name, student_surname, student_login FROM students WHERE student_id = '$studentId'");

        $studentAssoc = mysqli_fetch_assoc($studentGetQuery);
        $sertificateData['student_first_name'] = $studentAssoc['student_first_name'];
        $sertificateData['student_surname'] = $studentAssoc['student_surname'];
        $sertificateData['student_login'] = $studentAssoc['student_login'];
        
        $courseGetQuery = mysqli_query($connection,
            "SELECT course_id, course_name, course_category, course_length, course_descr FROM courses WHERE course_id = '$courseId'");
    
        $courseAssoc = mysqli_fetch_assoc($courseGetQuery);
        $sertificateData['course_name'] = $courseAssoc['course_name'];
        $sertificateData['course_category'] = $courseAssoc['course_category'];
        $sertificateData['course_length'] = $courseAssoc['course_length'];
        $sertificateData['course_descr'] = $courseAssoc['course_descr'];
        $sertificateData['result'] = $result . ' из 10 баллов';

        $groupId = $_SESSION['group']['id'];
        $mentorGetQuery = mysqli_query($connection,
            "SELECT name, owner_name, owner_surname FROM groups WHERE id = '$groupId'");
    
        $mentorAssoc = mysqli_fetch_assoc($mentorGetQuery);
        $sertificateData['mentor_name'] = $mentorAssoc['owner_name'];
        $sertificateData['mentor_surname'] = $mentorAssoc['owner_surname'];
        $sertificateData['group_name'] = $mentorAssoc['name'];
        
        return $sertificateData;
    }

    public static function createSertificate($sertificateData){
        /*echo "<pre>";
        var_dump($sertificateData);
        echo "</pre>";*/
        
        require('vendor\tpdf\tfpdf.php');

        $pdf = new tFPDF();
        $pdf->AddPage();

        // Add a Unicode font (uses UTF-8)
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->SetFont('DejaVu','', 30);

        // Load a UTF-8 string from a file and print it
        $txt = 'Сертификат';
        $pdf->Ln(10);
        $result = 'Об успешном окончании курса на портале';
        $pdf->Write(5, $txt);
        $pdf->SetFont('Dejavu','', 14);
        $pdf->Ln(10);
        $pdf->Write(5, $result);

        // Select a standard font (uses windows-1252)
        $pdf->SetFont('Dejavu','', 14);
        $pdf->Ln(10);
        $pdf->Write(5, "Выдан студенту: " . $sertificateData['student_first_name'] . " " . $sertificateData['student_surname']);
        $pdf->Ln(10);
        $pdf->Write(5, "Логин студента: " . $sertificateData['student_login']);
        $pdf->Ln(10);
        $pdf->Write(5, "Название курса: " . $sertificateData['course_name']);
        $pdf->Ln(10);
        $pdf->Write(5, "Дисциплина курса: " . $sertificateData['course_category']);
        $pdf->Ln(10);
        $pdf->Write(5, "Длительность курса (в часах): " . $sertificateData['course_length']);
        $pdf->Ln(10);
        $pdf->Write(5, "Описание курса: " . $sertificateData['course_descr']);
        $pdf->Ln(10);
        $pdf->Write(5, "Результат итогового теста: " . $sertificateData['result']);
        $pdf->Ln(10);
        $pdf->Write(5, "Руководитель: " . $sertificateData['mentor_name'] . " " . $sertificateData['mentor_surname']);
        $pdf->Ln(10);
        $pdf->Write(5, "Название учебной группы: " . $sertificateData['group_name']);

        $pdf->Output();
    }
}
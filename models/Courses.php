<?php

class Courses{

    // !! РАЗОБРАТЬСЯ, КАК ПРОПИСАТЬ ПРИСВАИВАНИЕ CONNECTION 1 РАЗ, А НЕ В КАЖДОЙ Ф-ЦИИ

    public static function getCourseItemById($id){

        $connection = Db::getConnection();
        $courseQuery = mysqli_query($connection, "SELECT * FROM courses
                                                  WHERE course_id = '$id'");
        
        $course = mysqli_fetch_assoc($courseQuery);

        return $course;
    }   
    
    public static function getCoursesList(){

        $connection = Db::getConnection();

        $coursesList = [];
        $coursesListQuery = mysqli_query($connection, "SELECT * FROM courses");

        while($coursesBuf = mysqli_fetch_assoc($coursesListQuery)){
            $coursesList[] = $coursesBuf;
        }

        return $coursesList;
    }

    public static function getTopics($id){
        
        $connection = Db::getConnection();

        $topics = [];
        $topicsQuery = mysqli_query($connection, "SELECT * FROM topics WHERE course_id = '$id'");
        
        while($topicsBuf = mysqli_fetch_assoc($topicsQuery)){
            $topics[] = $topicsBuf;
        }

        return $topics;
    }

    public static function courseStart($courseId, $studentId){

        // ! Привести эту функцию в порядок

        $connection = Db::getConnection();

        // Опробовать вариант получить название курса, вместо id
        $getCourseTitleQuery = mysqli_query($connection, "SELECT course_name FROM courses
                                                          WHERE course_id = '$courseId'");
        $courseAssoc = mysqli_fetch_assoc($getCourseTitleQuery);
        $courseName = $courseAssoc["course_name"];

        //$addCourseIdQuery = mysqli_query($connection, "UPDATE students SET course_ids='$courseId' WHERE student_id='$studentId'");

        //$qqq = mysqli_query($connection, "INSERT INTO students (course_ids) VALUES ('$courseId')");
    }
}
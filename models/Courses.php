<?php

class Courses{

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
        $topics = [];
        $connection = Db::getConnection();
        $topicsIdsQuery = mysqli_query($connection, "SELECT topics FROM courses WHERE course_id = '$id'");
        
        $topicsIdsAssoc = mysqli_fetch_assoc($topicsIdsQuery);
        $topicsIds = explode(',', $topicsIdsAssoc['topics']);

        for($i = 0; $i < sizeof($topicsIds); $i++){
            $topicsGetQuery = mysqli_query($connection,
                "SELECT topic_id, topic_img, topic_title FROM topics WHERE topic_id = '{$topicsIds[$i]}'");

            $topics[] = mysqli_fetch_assoc($topicsGetQuery);
        }

        return $topics;
    }

    public static function courseStart($courseId, $studentId){
        $connection = Db::getConnection();

        // Опробовать вариант получить название курса, вместо id
        $getCourseTitleQuery = mysqli_query($connection,
            "SELECT course_name FROM courses WHERE course_id = '$courseId'");
            
        $courseAssoc = mysqli_fetch_assoc($getCourseTitleQuery);
        $courseName = $courseAssoc["course_name"];

        //$addCourseIdQuery = mysqli_query($connection, "UPDATE students SET course_ids='$courseId' WHERE student_id='$studentId'");

        //$qqq = mysqli_query($connection, "INSERT INTO students (course_ids) VALUES ('$courseId')");
    }

    public static function courseAdd($course){
        $connection = Db::getConnection();
        $lastCourseId = '';

        $courseName = $course["courseName"];
        $courseCategory = $course["courseCategory"];
        $courseLength = $course["courseLength"];
        $courseDescr = $course["courseDescr"];
        
        $lastCourseGetQuery = mysqli_query($connection,
            "SELECT course_id FROM courses ORDER BY course_id DESC");
        $lastCourseAssoc = mysqli_fetch_assoc($lastCourseGetQuery);

        if($lastCourseAssoc['course_id'] == null){
            $lastCourseId = 1;
        }else{
            $lastCourseId = $lastCourseAssoc['course_id'] + 1;
        }

        $type = explode('/', $_FILES['courseImage']['type']);
        $extension = $type[1];
            
        $courseImgPath = "templates/images/courses/" . $lastCourseId . "." . $extension;

        $flag = self::checkCourseExistance($courseName);
        
        if($flag == true){
            if(!move_uploaded_file($_FILES['courseImage']['tmp_name'], $courseImgPath)){
                $_SESSION['avatarError'] = "Не удалось загрузить фото. Попробуйте загрузить его из профиля";
            }

            $courseAddQuery = mysqli_query($connection, "INSERT INTO courses (
                                                                    course_img,
                                                                    course_name,
                                                                    course_category,
                                                                    course_length,
                                                                    course_descr
                                                                    )
                                                            VALUES ('$courseImgPath',
                                                                    '$courseName',
                                                                    '$courseCategory',
                                                                    '$courseLength',
                                                                    '$courseDescr'
                                                                    )");
            $courseAddResult = "Курс был успешно добавлен";
        }/*else{
            $courseAddResult = "Курс с таким названием уже существует";
        }*/

        return $courseAddResult;
    }

    public static function checkCourseExistance($courseName){
        $flag = false;
        $connection = Db::getConnection();

        $courseExistanceQuery = mysqli_query($connection, 
            "SELECT * FROM courses WHERE course_name = '$courseName'");
        $courseExistanceAssoc = mysqli_fetch_assoc($courseExistanceQuery);

        if($courseExistanceAssoc == null){
            $flag = true;
            return $flag;
        }else{
            return $flag;
        }
    }
}
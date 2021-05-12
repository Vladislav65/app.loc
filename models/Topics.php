<?php 

/** Модель тем курсов */

class Topics{

    public static function getTopic($id){
        $connection = Db::getConnection();

        $topicQuery = mysqli_query($connection, "SELECT * FROM topics
                                                  WHERE topic_id = '$id'");
        
        $topic = mysqli_fetch_assoc($topicQuery);

        return $topic;
    }

    public static function topicAdd($topic, $courseId){
        $connection = Db::getConnection();
        $lastInsertId = '';

        $lastIdQuery = mysqli_query($connection,
            "SELECT topic_id FROM topics ORDER BY topic_id DESC");
        $lastInsertIdAssoc = mysqli_fetch_assoc($lastIdQuery);

        if($lastInsertIdAssoc == null){
            $lastInsertId = 0;
        }else{
            $lastInsertId = $lastInsertIdAssoc['topic_id'];
        }
        
        /*if(!(empty($_FILES['topicImage']['tmp_name']))){
            $type = explode('/', $_FILES['topicImage']['type']);
            $path = 'templates/images/topics/' . $lastInsertId . '.' . $type[1];
            move_uploaded_file($_FILES['topicImage']['tmp_name'], $path);
        }

        $saveTopicQuery = mysqli_query($connection,
            "INSERT INTO topics(topic_title, topic_img, topic_content)
            VALUES('{$topic['topicTitle']}', '{$path}', '{$topic['topic']}')");*/

        $selectTopicsCourseQuery = mysqli_query($connection,
            "SELECT topics FROM courses WHERE course_id = '$courseId'");

        $topicsAssoc = mysqli_fetch_assoc($selectTopicsCourseQuery);
        $topics = $topicsAssoc['topics'];

        if($topics == null){
            $updateTopicsQuery = mysqli_query($connection, 
            "UPDATE courses SET topics = '$lastInsertId' WHERE course_id = '$courseId'");
        }else{
            $topics = $topics . ',' . $lastInsertId;
            $updateTopicsQuery = mysqli_query($connection, 
            "UPDATE courses SET topics = '$topics' WHERE course_id = '$courseId'");
        }
        /*echo "<pre>";
        var_dump($topics);
        echo "</pre>";*/

        /*$getTopicQuery = mysqli_query($connection,
        "SELECT * FROM topics");

        $top = mysqli_fetch_assoc($getTopicQuery);
        $top = html_entity_decode($top['topic_content']);*/

        // после проверок
        return 1;
    }
}
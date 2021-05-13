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

    public static function topicAdd($topic, $courseId, $mentorId){
        $connection = Db::getConnection();
        $lastInsertId = '';

        $lastIdQuery = mysqli_query($connection,
            "SELECT topic_id FROM topics ORDER BY topic_id DESC");
        $lastInsertIdAssoc = mysqli_fetch_assoc($lastIdQuery);

        if($lastInsertIdAssoc == null){
            $lastInsertId = 1;
        }else{
            $lastInsertId = $lastInsertIdAssoc['topic_id'] + 1;
        }
        
        if(!(empty($_FILES['topicImage']['tmp_name']))){
            $type = explode('/', $_FILES['topicImage']['type']);
            $path = 'templates/images/topics/' . $lastInsertId . '.' . $type[1];
            move_uploaded_file($_FILES['topicImage']['tmp_name'], $path);
        }

        $saveTopicQuery = mysqli_query($connection,
            "INSERT INTO topics(topic_title, topic_img, topic_content)
            VALUES('{$topic['topicTitle']}', '{$path}', '{$topic['topic']}')");

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

        $increaseRateQuery = mysqli_query($connection, 
            "SELECT rating FROM mentors WHERE mentor_id = '$mentorId'");
        $rateAssoc = mysqli_fetch_assoc($increaseRateQuery);

        $updatedRate = $rateAssoc['rating'] + 3;
        $updateRateQuery = mysqli_query($connection,
            "UPDATE mentors SET rating = '$updatedRate' WHERE mentor_id = '$mentorId'");

        // после проверок
        return true;
    }

    public static function getCourseTopics($topicsIds){
        $connection = Db::getConnection();
        $topicsIds = explode(',', $topicsIds);
        $topics = [];

        for($i = 0; $i < sizeof($topicsIds); $i++){
            $getTopicsQuery = mysqli_query($connection,
            "SELECT * FROM topics WHERE topic_id = '{$topicsIds[$i]}'");

            $topics[] = mysqli_fetch_assoc($getTopicsQuery);
        }

        if($topics[0] != null){
            foreach($topics as &$item){
                $item['topic_content'] = html_entity_decode($item['topic_content']);
            }
        }else{
            $topics = 'В данном курсе отсутствуют темы';
        }

        return $topics;
    }
}
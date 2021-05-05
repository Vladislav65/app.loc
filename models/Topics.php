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
}
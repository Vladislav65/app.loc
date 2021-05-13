<?php

include_once SITE_PATH . DS . "models" . DS . "Topics.php";

/* Класс-контроллер, отвечающий за функционал тем курсов */

class TopicsController{

    public static function actionView($id){
        $topic = Topics::getTopic($id);

        require_once SITE_PATH . DS . "views" . DS . "topic.php";
        
        return true;
    }

    public function actionTopicAdd($comparedId){
        $comparedId = explode(';', $comparedId);
        $courseId = $comparedId[0];
        $mentorId = $comparedId[1];
        if(isset($_POST['topicAdd'])){
            $topic = $_POST;
            $topic['topic'] = filter_var(htmlentities($topic['topic']), FILTER_SANITIZE_STRING);

            $result = Topics::topicAdd($topic, $courseId, $mentorId);
        }
        
        require_once SITE_PATH . DS . "views" . DS . "topicAdd.php";
        
        return true;
    }
}
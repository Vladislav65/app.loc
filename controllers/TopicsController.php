<?php

include_once SITE_PATH . DS . "models" . DS . "Topics.php";

/* Класс-контроллер, отвечающий за функционал тем курсов */

class TopicsController{

    public static function actionView($id){
        $studentId = $_SESSION['student']['student_id'];
        $isLearned = Topics::isLearned($id, $studentId);
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
            // после проверок

            //exit("<meta http-equiv='refresh' content='0; url=manageCourse{$courseId}'>");
        }
        
        require_once SITE_PATH . DS . "views" . DS . "topicAdd.php";
        
        return true;
    }

    public function actionUpdateTopic($comparedId){
        $comparedId = explode(';', $comparedId);
        $topicId = $comparedId[0];
        $mentorId = $comparedId[1];
        $courseId = $comparedId[2];

        $topic = Topics::getTopic($topicId);
        $topic['topic_content'] = html_entity_decode($topic['topic_content']);

        if(isset($_POST['updateTopic'])){
            $updatedTopic = $_POST;

            Topics::updateTopic($updatedTopic, $topicId, $mentorId, $topic['topic_img']);
            exit("<meta http-equiv='refresh' content='0; url=manageCourse{$courseId}'>");
        }

        require_once SITE_PATH . DS . "views" . DS . "updateTopic.php";
        
        return true;
    }
}
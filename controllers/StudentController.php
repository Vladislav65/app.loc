<?php

include_once SITE_PATH . DS . "models" . DS . "User.php";
include_once SITE_PATH . DS . "models" . DS . "OfferControl.php";
include_once SITE_PATH . DS . "models" . DS . "Student.php";
include_once SITE_PATH . DS . "models" . DS . "Mentors.php";
include_once SITE_PATH . DS . "models" . DS . "Tests.php";

/* Класс-контроллер аккаунта студента */

class StudentController{

    public function actionIndex(){
        require_once SITE_PATH . DS . "views" . DS . "student.php";

        return true;
    }

    public function actionMakeOffer($mentorId){
        if(isset($_POST['offer'])){
            $speciality = filter_var(trim($_POST['speciality']), FILTER_SANITIZE_STRING);
            $eDirections = filter_var(trim($_POST['eDirections']), FILTER_SANITIZE_STRING);
            $lDirections = filter_var(trim($_POST['lDirections']), FILTER_SANITIZE_STRING);
            $format = $_POST['format'];
            $days = $_POST['days'];
            $experience = $_POST['experience'];
        }

        if($speciality == "Экономика"){
            $offerArray = array(
                "speciality" => $speciality,
                "add" => $eDirections,
                "format" => $format, 
                "days" => $days,
                "experience" => $experience
            );
        }else if($speciality == "Логистика"){
            $offerArray = array(
                "speciality" => $speciality,
                "add" => $lDirections,
                "format" => $format, 
                "days" => $days,
                "experience" => $experience
            );
        }
        
        if(sizeof($offerArray) == 5){
            $result = AnalyzeOffer::analyze($offerArray, $mentorId);
            foreach($result as $elem){
                if(is_array($elem)){
                self::makeReject($result);
                exit("<meta http-equiv='refresh' content='0; url= offerResult'>");
                break;
                }else if($elem == "underConsideration"){
                    self::makeUnderConsideration($result);
                    exit("<meta http-equiv='refresh' content='0; url= offerResult'>");
                }else if($elem == "accepted"){
                    self::makeAccept($result);
                    exit("<meta http-equiv='refresh' content='0; url= offerResult'>");
                }
            }
        }
        
        require_once SITE_PATH . DS . "views" . DS . "offer.php";

        return true;
    }

    public function actionOfferResult(){
        require_once SITE_PATH . DS . "views" . DS . "offerResult.php";

        return true;
    }

    public static function makeReject($result){
        $errorStack = [];       
        foreach($result as $error){
            $errorStack[] = $error[2];
        }
        $errorStackSize = sizeof($errorStack);

        for($i = 0; $i < $errorStackSize; $i++){
            switch($errorStack[$i]){
                case "experience":
                    $_SESSION['rejectOffer'][] = "Ваш опыт изучения дисциплины больше опыта ментора";
                break;

                case "speciality":
                    $_SESSION['rejectOffer'][] = "Желаемая к изучению специальность не совпадает со специальностью ментора";
                break;

                case "days":
                    $_SESSION['rejectOffer'][] = "График занятий, указанный в заявке, не совпадает с графиком ментора";
                break;

                case "format":
                    $_SESSION['rejectOffer'][] = "Выбранный формат занятий не совпадает с форматом ментора";
                break;
            }
        }
    }

    public static function makeUnderConsideration($result){
        $_SESSION['underConsideration'] = "Указанная в заявке дополнительная специальность
        не соответствует дополнительной специальности ментора. Заявка передана ментору для
        определения статуса.";
    }

    public static function makeAccept($result){
        $_SESSION['accepted'] = "Заявка успешно сформирована. Ориентировочная стоимость месяца
        менторства составит порядка" . " $result[3]" . "$";
    }

    public static function actionInvitations(){
        $studentId = $_SESSION['student']['student_id'];

        $invitationsList = Student::getInvitations($studentId);

        if(empty($invitationsList)){
            $result = 'В данный момент приглашения в группы отсутствуют';
        }

        require_once SITE_PATH . DS . "views" . DS . "viewInvitations.php";

        return true;
    }

    public static function actionJoin($id){
        $studentId = $_SESSION['student']['student_id'];

        $flag = Student::join($studentId, $id);

        if($flag === true){
            exit("<meta http-equiv='refresh' content='0; url= student'>");
        }
    }

    public static function actionDecline($id){
        $studentId = $_SESSION['student']['student_id'];

        $flag = Student::decline($studentId, $id);

        if($flag === true){
            exit("<meta http-equiv='refresh' content='0; url= student'>");
        }
    }

    public function actionGroups(){
        $studentId = $_SESSION['student']['student_id'];

        $fullGroups = Student::getGroups($studentId);

        require_once SITE_PATH . DS . "views" . DS . "groups.php";

        return true;
    }

    public function actionViewGroup($groupId){
        $_SESSION['group'] = [
            'id' => $groupId
        ];

        $group = Mentors::getGroupById($groupId);
        
        require_once SITE_PATH . DS . "views" . DS . "viewGroup.php";

        return true;
    }

    public function actionLearned($topicId){
        $studentId = $_SESSION['student']['student_id'];

        $flag = Student::topicLearned($topicId, $studentId);

        if($flag === true){
            exit("<meta http-equiv='refresh' content='0; url= topic{$topicId}'>");
        }
    }

    public function actionGroupsAvailable(){
        $studentId = $_SESSION['student']['student_id'];
        $groupsList = Student::getAvailableGroups($studentId);

        require_once SITE_PATH . DS . "views" . DS . "allGroups.php";

        return true;
    }

    public function actionEnterGroup($groupId){
        $studentId = $_SESSION['student']['student_id'];

        $flag = Student::enterGroup($studentId, $groupId);
        if($flag === true){
            exit("<meta http-equiv='refresh' content='0; url= groupsAvailable'>");
        }
    }
}
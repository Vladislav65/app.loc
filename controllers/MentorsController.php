<?php

include_once SITE_PATH . DS . "models" . DS . "Mentors.php";
include_once SITE_PATH . DS . "controllers" . DS . "AdminController.php";
include_once SITE_PATH . DS . "controllers" . DS . "CoursesController.php";

/* Контроллер раздела "Менторы" */

class MentorsController{

    public function actionIndex(){
        $mentorsList = [];
        $mentorsList = Mentors::getMentorsList();
        
        require_once SITE_PATH . DS . "views" . DS . "mentors.php";

        return true;
    }

    public function actionView($mentorId){
        $mentor = Mentors::getMentorById($mentorId);

        require_once SITE_PATH . DS . "views" . DS . "mentor.php";

        return true;
    }

    public static function actionTest(){
        if(isset($_POST['mentorTest'])){
            $sphere = filter_var(trim($_POST['sphere']), FILTER_SANITIZE_STRING);
            $eDirections = filter_var(trim($_POST['eDirections']), FILTER_SANITIZE_STRING);
            $lDirections = filter_var(trim($_POST['lDirections']), FILTER_SANITIZE_STRING);
            $experience = filter_var(trim($_POST['experience']), FILTER_SANITIZE_STRING);
            $graduation = filter_var(trim($_POST['graduation']), FILTER_SANITIZE_STRING);
            $format = $_POST['format'];
            $days = $_POST['days'];
            $age = filter_var(trim($_POST['age']), FILTER_SANITIZE_STRING);
            $rating = filter_var(trim($_POST['rating']), FILTER_SANITIZE_STRING);
        }

        if($sphere == "Экономика"){
            $mentorTestArray = array(
                "sphere" => $sphere,
                "add" => $eDirections,
                "experience" => $experience,
                "graduation" => $graduation,
                "format" => $format, 
                "days" => $days,
                "age" => $age,
                "rating" => $rating
            );
        }else if($sphere == "Логистика"){
            $mentorTestArray = array(
                "sphere" => $sphere,
                "add" => $lDirections,
                "experience" => $experience,
                "graduation" => $graduation,
                "format" => $format, 
                "days" => $days,
                "age" => $age,
                "rating" => $rating
            );
        }

        //после проверок 
        //!! При изменении кол-ва параметров нужно редактировать значение сайзоф
        if(sizeof($mentorTestArray) == 8){
            $recommended = Mentors::mentorTest($mentorTestArray);
            MentorsController::mentorRecommended($recommended);
            exit();
        }

        require_once SITE_PATH . DS . "views" . DS . "mentorTest.php";
        
        return true;
    }

    public static function mentorRecommended($recommended){
        // Чтобы не путались индексы, формируем новый массив
        $idS = array_slice($recommended, 0, 3);
        $topMentors = Mentors::getRecommendedMentors($idS);

        // Очищаем подмассивы нулл в массиве 
        if($topMentors[1] == NULL){
            unset($topMentors[1]);
        }

        if($topMentors[2] == NULL){
            unset($topMentors[2]);
        }

        require_once SITE_PATH . DS . "views" . DS . "recommendedMentor.php";

        return true;
    }

    public static function actionMain(){
        require_once SITE_PATH . DS . "views" . DS . "mentorPage.php";
    }

    public static function actionCreateGroup(){
        if(isset($_POST['createGroup'])){
            unset($_POST['createGroup']);
            $groupInfo = $_POST;
            
            if($groupInfo['speciality'] == "economics"){
                $groupInfo['add_speciality'] = $groupInfo['eDirections'];
                unset($groupInfo['lDirections']);
                unset($groupInfo['eDirections']);
            }else if($groupInfo['speciality'] == "logistics"){
                $groupInfo['add_speciality'] = $groupInfo['lDirections'];
                unset($groupInfo['eDirections']);
                unset($groupInfo['lDirections']);
            }

            $flag = Mentors::createGroup($groupInfo);

            if($flag == true){
                $result = 'Группа успешно добавлена';
            }
        }
        
        require_once SITE_PATH . DS . "views" . DS . "createGroup.php";

        return true;
    }

    public static function actionViewGroups(){
        $groups = Mentors::getGroups();

        require_once SITE_PATH . DS . "views" . DS . "myGroups.php";

        return true;
    }

    public static function actionInviteStudents($groupId){
        $students = Mentors::getStudents($groupId);
        $_SESSION['group_id'] = $groupId;

        if($students == false){
            $result = "В данный момент на портале нет студентов";
        }

        require_once SITE_PATH . DS . "views" . DS . "inviteStudents.php";

        return true;
    }

    public static function actionSendInvitation($studentId){
        $groupId = $_SESSION['group_id'];
        unset($_SESSION['group_id']);

        $invitationResult = Mentors::sendInvitation($groupId, $studentId);

        require_once SITE_PATH . DS . "views" . DS . "inviteStudents.php";

        return true;
    }

    public static function actionCourseAdd($groupId){
        $newCourse = new CoursesController();
        $flag = $newCourse->actionCourseAdd();
    
        if($flag == 'Курс был успешно добавлен'){
            Mentors::insertCourseToGroup($groupId);
            exit("<meta http-equiv='refresh' content='0; url= manageGroup{$groupId}'>");
        }

        /*require_once SITE_PATH . DS . "views" . DS . "courseAdd.php";*/

        return true;
    }

    public function actionManageGroup($id){
        $group = Mentors::getGroupById($id);
        $coursesNum = sizeof($group['coursesList']);

        for($i = 0; $i < $coursesNum; $i++){
            if($group['coursesList'][$i] == null){
                unset($group['coursesList'][$i]);
            }
        }

        require_once SITE_PATH . DS . "views" . DS . "manageGroup.php";

        return true;
    }

    public function actionDeleteCourse($courseId){
        $flag = Mentors::deleteCourse($courseId);

        if($flag == true){
            exit("<meta http-equiv='refresh' content='0; url= mentorMyGroups'>");
        }
    }

    public function actionUpdateCourse($comparedId){
        $comparedId = explode(';', $comparedId);
        $courseId = $comparedId[0];
        $groupId = $comparedId[1];
    
        $oldData = Mentors::getCourseForUpdate($courseId);

        if(isset($_POST['updateCourse'])){
            $updateData = $_POST;
            $updateResult = Mentors::updateCourse($updateData, $courseId, $oldData['course_img']);
            exit("<meta http-equiv='refresh' content='0; url=manageGroup{$groupId}'>");
        }
        
        require_once SITE_PATH . DS . "views" . DS . "updateCourse.php";

        return true;
    }

    public function actionManageCourse($comparedId){
        $comparedId = explode(';', $comparedId);
        $courseId = $comparedId[0];
        $groupId = $comparedId[1];
        
        $courseTopics = Mentors::manageCourse($courseId, $groupId);
        $courseTests = Mentors::getTests($courseId, $groupId);

        /*echo "<pre>";
        var_dump($courseTests);
        echo "</pre>";*/

        require_once SITE_PATH . DS . "views" . DS . "manageCourse.php";

        return true;
    }

    public function actionSendEmail($comparedId){
        $comparedId = explode(';', $comparedId);
        $studentId = $comparedId[1];
        $groupId = $comparedId[0];
        $messageType = 'email';
        $mentorId = $_SESSION['mentor']['mentor_id'];

        if(isset($_POST['emailBtn'])){
            $email = $_POST;

            $flag = Mentors::sendEmail($studentId, $mentorId, $email);
            
            if($flag == true){
                exit("<meta http-equiv='refresh' content='0; url=manageGroup{$groupId}'>");
            }
        }
        
        require_once SITE_PATH . DS . "views" . DS . "sendMessage.php";

        return true;
    }
}
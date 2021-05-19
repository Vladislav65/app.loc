<?php

/* Модель студента */

class Student{

    public static function getInvitations($studentId){
        $connection = Db::getConnection();
        $invitationList = [];
        $invitationData = [];

        $invitationsGetQuery = mysqli_query($connection,
            "SELECT * FROM invitations WHERE student_id = '$studentId'");
        
        while($invitationsAssoc = mysqli_fetch_assoc($invitationsGetQuery)){
            $invitationList[] = $invitationsAssoc;
        }

        for($i = 0; $i < sizeof($invitationList); $i++){
            if($invitationList[$i]['status'] != 'sent') continue;

            $mentorGetQuery = mysqli_query($connection,
                "SELECT mentor_login FROM mentors
                 WHERE mentor_id = '{$invitationList[$i]['mentor_id']}'");

            while($mentorGetAssoc = mysqli_fetch_assoc($mentorGetQuery)){
                $invitationMentor = $mentorGetAssoc;
            }
            
            $groupGetQuery = mysqli_query($connection,
                "SELECT * FROM groups
                 WHERE id = '{$invitationList[$i]['group_id']}'");

            while($groupGetAssoc = mysqli_fetch_assoc($groupGetQuery)){
                $invitationGroup = $groupGetAssoc;
            }
            $invitationGroup['invitation_id'] = $invitationList[$i]['id'];

            $invitationData[] = array_merge($invitationMentor, $invitationGroup);
        }

        return $invitationData;
    }

    public static function join($studentId, $id){
        $connection = Db::getConnection();
        $joinQuery = mysqli_query($connection,
        "UPDATE invitations SET status = 'accepted' WHERE id = '$id' AND student_id = '$studentId'");

        $getGroupQuery = mysqli_query($connection,
        "SELECT group_id FROM invitations WHERE id = '$id' AND student_id = '$studentId'");
        
        $group_id = mysqli_fetch_assoc($getGroupQuery);

        $joinGroupQuery = mysqli_query($connection, 
        "SELECT students FROM groups WHERE id = '{$group_id['group_id']}'");

        $recordGroupQuery = mysqli_query($connection,
        "SELECT groups FROM students WHERE student_id = '{$studentId}'");

        $recordGroupAssoc = mysqli_fetch_assoc($recordGroupQuery);
        if($recordGroupAssoc['groups'] == null){
            $insertGroupQuery = mysqli_query($connection,
            "UPDATE students SET groups = '{$group_id['group_id']}' WHERE student_id = '$studentId'");
        }else{
            $lastGroupQuery = mysqli_query($connection,
            "SELECT groups FROM students WHERE student_id = '$studentId'"); 

            $groupsList = mysqli_fetch_assoc($lastGroupQuery);

            $updatedGroupsList = $groupsList['groups'] . "," . $group_id['group_id'];

            $insertGroupQuery= mysqli_query($connection,
            "UPDATE students SET groups = '$updatedGroupsList' WHERE student_id = '$studentId'");
        }

        $students = mysqli_fetch_assoc($joinGroupQuery);

        if($students['students'] == null){
            $insertStudentQuery = mysqli_query($connection,
            "UPDATE groups SET students = '$studentId' WHERE id = '{$group_id['group_id']}'");
        }else{
            $lastStudentQuery = mysqli_query($connection,
            "SELECT students FROM groups WHERE id = '{$group_id['group_id']}'"); 

            $studentsList = mysqli_fetch_assoc($lastStudentQuery);

            $updatedStudentsList = $studentsList['students'] . "," . $studentId;

            $insertStudentQuery= mysqli_query($connection,
            "UPDATE groups SET students = '{$updatedStudentsList}' WHERE id = '{$group_id['group_id']}'");
        }

        return true;
    }

    public static function decline($studentId, $id){
        $connection = Db::getConnection();
        $joinQuery = mysqli_query($connection,
        "UPDATE invitations SET status = 'rejected' WHERE id = '$id' AND student_id = '$studentId'");
        
        return true;
    }

    public static function getGroups($studentId){
        $groupsList = [];
        $fullGroups = [];

        $connection = Db::getConnection();
        $groupsGetQuery = mysqli_query($connection,
            "SELECT groups FROM students WHERE student_id = '{$studentId}'");

        $groupsAssoc = mysqli_fetch_assoc($groupsGetQuery);

        $groupsList = explode(',', $groupsAssoc['groups']);

        for($i = 0; $i < sizeof($groupsList); $i++){
            $groupsGet = mysqli_query($connection, 
                "SELECT * FROM groups WHERE id = '{$groupsList[$i]}'");
            $fullGroups[] = mysqli_fetch_assoc($groupsGet);
        }

        return $fullGroups;
    }

    public static function topicLearned($topicId, $studentId){
        $topicId = (int) $topicId;
        $topicsList = [];

        $connection = Db::getConnection();
        $topicsLearnedQuery = mysqli_query($connection,
            "SELECT rating, topics_learned FROM students WHERE student_id = '$studentId'");

        $topicsAssoc = mysqli_fetch_assoc($topicsLearnedQuery);

        if($topicsAssoc['topics_learned'] == null){
            array_push($topicsList, $topicId);
            $topicsList = json_encode($topicsList, JSON_FORCE_OBJECT);

            $insertTopics = mysqli_query($connection,
                "UPDATE students SET topics_learned = '$topicsList' WHERE student_id = '$studentId'");
        }else{
            $topicsList = json_decode($topicsAssoc['topics_learned'], true);
            array_push($topicsList, $topicId);
            $topicsList = json_encode($topicsList, JSON_FORCE_OBJECT);

            $insertTopics = mysqli_query($connection,
                "UPDATE students SET topics_learned = '$topicsList' WHERE student_id = '$studentId'");
        }

        $updatedRate = $topicsAssoc['rating'] + 4;
        $updateRateQuery = mysqli_query($connection,
            "UPDATE students SET rating = '$updatedRate' WHERE student_id = '$studentId'");
    
        // после проверок
        return true;
    }

    public static function getAvailableGroups($studentId){
        $groupsList = [];

        $connection = Db::getConnection();
        $groupsGetQuery = mysqli_query($connection,
            "SELECT * FROM groups WHERE status = 'opened'"); 

        while($groupsAssoc = mysqli_fetch_assoc($groupsGetQuery)){
            $groupsList[] = $groupsAssoc;
        }

        if(!(empty($groupsList))){
            foreach($groupsList as $key => &$value){
                $explodedStudents = explode(',', $value['students']);
                for($i = 0; $i < sizeof($explodedStudents); $i++){
                    if($studentId == $explodedStudents[$i]){
                        $value['isMember'] = true;
                    }else{
                        $value['isMember'] = false;
                    }
                }
            }
        }else{
            return false;
        }

        return $groupsList;         
    }

    public static function enterGroup($studentId, $groupId){
        $connection = Db::getConnection();
        $studentsGetQuery = mysqli_query($connection,
            "SELECT students FROM groups WHERE id = '$groupId'"); 

        $studentsGetAssoc = mysqli_fetch_assoc($studentsGetQuery);

        if($studentsGetAssoc['students'] == null){
            $studentsList = $studentId;
            $studentsUpdateQuery = mysqli_query($connection,
                "UPDATE groups SET students = '$studentsList' WHERE id = '$groupId'");
        }else{
            $studentsList = $studentsGetAssoc['students'] . ',' . $studentId;
            $studentsUpdateQuery = mysqli_query($connection,
                "UPDATE groups SET students = '$studentsList' WHERE id = '$groupId'");
        }

        // после проверок
        return true;
    }
}
<?php 

/* Модель контроля заявок (присуствуют несколько классов) */

class AnalyzeOffer{

    public static function analyze($offerArray, $mentorId){
        $acceptedOffers = [];
        $rejectedOffers = [];

        $connection = Db::getConnection();

        $student = $_SESSION['student'];
        /*echo "<pre>";
        var_dump($offerArray);
        echo "</pre>";*/

        $getMentorQuery = mysqli_query($connection, "SELECT * FROM mentors WHERE mentor_id = '$mentorId'");
        $mentor = mysqli_fetch_assoc($getMentorQuery);

        // Проверка на соответствие опыта ментора и студента
        if($offerArray['experience'] >= $mentor['experience']){
            $rejectedOffers[] = $student['student_id'] . "-" . $mentor['mentor_id'] . "-" . "experience";
        }

        // Проверка специализации ментора и заявки
        if($offerArray['speciality'] != $mentor['speciality']){
            $rejectedOffers[] = $student['student_id'] . "-" . $mentor['mentor_id'] . "-" . "speciality";
        }

        // Проверка совпадения дней занятий
        if(self::checkDays($offerArray['days'], $mentor['days']) == false){
            $rejectedOffers[] = $student['student_id'] . "-" . $mentor['mentor_id'] . "-" . "days";
        }

        // Проверка совпадения формата занятий
        if(self::checkFormat($offerArray['format'], $mentor['format']) == false){
            $rejectedOffers[] = $student['student_id'] . "-" . $mentor['mentor_id'] . "-" . "format";
        }

        if(sizeof($rejectedOffers) != 0){
            $rejected = self::makeReject($rejectedOffers);
            return $rejected;
        }else{
            $offer = self::makeOffer($offerArray, $student, $mentor);
            return $offer;
        }
    }

    private static function makeOffer($offerArray, $student, $mentor){
        $connection = Db::getConnection();

        if($offerArray['add'] != $mentor['add_speciality']){
            $underConsiderationOffer = $student['student_id'] . "-" . $mentor['mentor_id'] . "-" . "underConsideration";
            $underConsiderationOfferArray = explode("-", $underConsiderationOffer);
            $studentId = $underConsiderationOfferArray[0];
            $mentorId = $underConsiderationOfferArray[1];
            $offerStatus = "underConsideration";
            
            $offerQuery = mysqli_query($connection, "INSERT INTO offers(student_id,
                                                                 mentor_id,
                                                                 offer_status)
                                                     VALUES('$studentId',
                                                            '$mentorId',
                                                            '$offerStatus')");
            
            return $underConsiderationOfferArray;

        }else{
            $ratesPath = SITE_PATH . DS . "components" . DS . "rates.php";
            $rates = include($ratesPath);
            $studentId = $student['student_id'];
            $mentorId = $mentor['mentor_id'];
            $offerStatus = "accepted";
        
            switch($mentor['graduation']){
                case "Бакалавр":
                    $rate = $rates['bachelor'];
                break;

                case "Магистр":
                    $rate = $rates['magister'];
                break;

                case "Кандидат наук":
                    $rate = $rates['candidate'];
                break;

                case "Доктор наук":
                    $rate = $rates['doctor'];
                break;
            }

            $offerDays = $offerArray['days'];
            $mentorDays = $mentor['days'];
            $mentorDays = explode(",", $mentorDays);

            $daysPerWeek = sizeof(array_intersect($offerDays, $mentorDays));
            $daysPerMonth = $daysPerWeek * 4;
            $orientedPrice = $daysPerMonth * $mentor['price'] + $rate;
            $accepted[0] = $studentId;
            $accepted[1] = $mentorId;
            $accepted[2] = "accepted";
            $accepted[3] = $orientedPrice; 
            
            $offerQuery = mysqli_query($connection, "INSERT INTO offers(student_id,
                                                                 mentor_id,
                                                                 offer_status)
                                                     VALUES('$studentId',
                                                            '$mentorId',
                                                            '$offerStatus')");

            return $accepted;                                                
        }
    }

    private static function makeReject($rejectedOffers){
        $connection = Db::getConnection();
        $rejected = [];
        
        $rejectedOffersSize = sizeof($rejectedOffers);
        for($i = 0; $i < $rejectedOffersSize; $i++){
            $rejected[] = explode("-", $rejectedOffers[$i]);
        }
        
        foreach($rejected as $elem){
            $studentId = $elem[0];
            $mentorId = $elem[1];
            $offerStatus = "rejected";
        }

        $offerQuery = mysqli_query($connection, "INSERT INTO offers(student_id,
                                                                    mentor_id,
                                                                    offer_status)
                                                 VALUES('$studentId',
                                                        '$mentorId',
                                                        '$offerStatus')");

        return $rejected;
    }

    private static function checkDays($offerDays, $mentorDays){
        $flag = true;
        $mentorDays = explode(",", $mentorDays);
    
        if(sizeof(array_intersect($offerDays, $mentorDays)) == 0){
            $flag = false;
        }

        return $flag;
    }

    private static function checkFormat($offerFormat, $mentorFormat){
        $flag = true;
        $mentorFormat = explode("-", $mentorFormat);

        if(sizeof(array_intersect($offerFormat, $mentorFormat)) == 0){
            $flag = false;
        }

        return $flag;
    }
}
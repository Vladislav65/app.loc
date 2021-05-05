<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рекомендуемые менторы</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/recommendedMentor.css">
</head>
<body>
    <?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>
    <?php 
    if($topMentors[0] != NULL) {
    ?>
        <div class="recMentorSection">
            <div class="bestMentor">
                <div class="mentorTop d-flex justify-content-center">
                    <img src="<?php echo $topMentors[0]["mentor_avatar"]; ?>" class="mentorAvatar">
                    <h3>Самый подходящий ментор: <?php echo $topMentors[0]["mentor_first_name"] . " " . $topMentors[0]["mentor_surname"]; ?></h3>
                </div>
                <p>Email: <?php echo $topMentors[0]["mentor_email"]; ?></p>
                <p>Логин: <?php echo $topMentors[0]["mentor_login"]; ?></p>
                <p>Специальность: <?php echo $topMentors[0]["speciality"]; ?></p>
                <p>Дополнительные специальности: <?php echo $topMentors[0]["add_speciality"]; ?></p>
                <p>Опыт изучения дисциплины: <?php echo $topMentors[0]["experience"]; ?> лет</p>
                <p>Рейтинг: <?php echo $topMentors[0]["rating"]; ?></p>
                <p>Учёная степень: <?php echo $topMentors[0]["graduation"]; ?></p>
                <p>Формат занятий: <?php echo $topMentors[0]["format"]; ?></p>
                <p>Дни занятий: <?php echo $topMentors[0]["days"]; ?></p>
                <p>Возраст: <?php echo $topMentors[0]["age"]; ?></p>
                <p style="margin-bottom: 20px;"><a href="#">Записаться</a></p>
            </div>
        </div>

        <div class="addMentorSection">
        <?php for($i = 1; $i < count($topMentors); $i++){ ?>

            <div class="addMentor">
                <div class="mentorTop d-flex justify-content-center">
                    <img src="<?php echo $topMentors[$i]["mentor_avatar"]; ?>" class="mentorAvatar">
                    <h3>Альтернативный ментор: <?php echo $topMentors[$i]["mentor_first_name"] . " " . $topMentors[$i]["mentor_surname"]; ?></h3>
                </div>
                <p>Email: <?php echo $topMentors[$i]["mentor_email"]; ?></p>
                <p>Логин: <?php echo $topMentors[$i]["mentor_login"]; ?></p>
                <p>Специальность: <?php echo $topMentors[$i]["speciality"]; ?></p>
                <p>Дополнительные специальности: <?php echo $topMentors[$i]["add_speciality"]; ?></p>
                <p>Опыт изучения дисциплины: <?php echo $topMentors[$i]["experience"]; ?> лет</p>
                <p>Рейтинг: <?php echo $topMentors[$i]["rating"]; ?></p>
                <p>Учёная степень: <?php echo $topMentors[$i]["graduation"]; ?></p>
                <p>Формат занятий: <?php echo $topMentors[$i]["format"]; ?></p>
                <p>Дни занятий: <?php echo $topMentors[$i]["days"]; ?></p>
                <p>Возраст: <?php echo $topMentors[$i]["age"]; ?></p>
                <p style="margin-bottom: 20px;"><a href="#">Записаться</a></p>
            </div>
            <?php
            }
            ?>
        </div>
    <?php
    }else{
    ?>
    <h3>На данный момент подходящих менторов на сайте нет</h3>
    <?php
    }
    ?>
    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>    
    <?php
    }else{
    echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
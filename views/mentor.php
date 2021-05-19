<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ментор: <?php echo $mentor["mentor_first_name"] . " " . $mentor["mentor_surname"] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/mentor.css">
    <link rel="stylesheet" href="../templates/css/courseAdmin.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="mentorMain">
        <div class="mentorHeader">
            <img src="<?php echo $mentor["mentor_avatar"]; ?>" class="mentorAvatar"> <br>
            <h4><?php echo $mentor["mentor_first_name"] . " " . $mentor["mentor_surname"]?></h4>
        </div>
        <p>Email: <?php echo $mentor["mentor_email"]; ?> </p>
        <p>Логин: <?php echo $mentor["mentor_login"]; ?> </p>
        <p>Основная специальность: <?php echo $mentor["speciality"]; ?> </p>
        <p>Дополнительная специальность: <?php echo $mentor["add_speciality"]; ?> </p>
        <p>Опыт изучения дисциплины: <?php echo $mentor["experience"]; ?> лет</p>
        <p>Рейтинг: <?php echo $mentor["rating"]; ?> </p>
        <p>Формат занятий: <?php echo $mentor["format"]; ?> </p>
        <p>Дни занятий: <?php echo $mentor["days"]; ?> </p>
        <p>Возраст: <?php echo $mentor["age"]; ?> лет</p>
        <p>О себе: <?php echo $mentor["about"]; ?> </p>
        <p><a href="makeOffer<?php echo $mentor["mentor_id"] ?>"><img class="topicPlusIcon" src="templates/images/topicPlusIcon.jpg" /></a> Оставить заявку на запись</p>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Менторы</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/mentors.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="mentorsSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mentorsCol">
                    <h3>Наши менторы:</h3>
                    <?php 
                    foreach($mentorsList as $mentor){
                    ?>
                        <div class="mentorBlock">
                            <div class="mentorHeader">
                                <?php
                                ?>
                                <img class="mentorImg" src="<?php echo $mentor['mentor_avatar'] ?>"> <br>
                                <div class="mentorTitle">
                                    <h4><?php echo $mentor['mentor_first_name'] . " " . $mentor['mentor_surname'] ?></h4>
                                    <p>Основная специализация: <?php echo $mentor['speciality'] ?></p>
                                    <p>Дополнительные специализации: <?php echo $mentor['add_speciality'] ?></p>
                                    <p>Опыт преподавания: <?php echo $mentor['experience'] ?> лет</p>
                                </div>
                            </div>
                            <p> 
                                <?php echo $mentor['about'] ?>
                            </p> 
                            <?php if(User::isLogged() == true){ ?>
                                <a href="mentors<?php echo $mentor["mentor_id"]; ?>">Подробнее</a>
                            <?php
                            }
                            ?>
                        </div>
                        <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
</body>
</html>
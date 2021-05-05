<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аккаунт ментора</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/student.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "MentorHeader.php" ?>
        <div class="mainAcc">
            <div class="sidebar"></div>
            <div class="account">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 greetingBlock">
                            <div class="headerGreeting">
                                <img class="avatar" src="<?php echo $_SESSION['mentor']['mentor_avatar'] ?>"> <br>
                                <h2 class="greeting">Добро пожаловать, <?php echo $_SESSION['mentor']['mentor_first_name'] . " " . $_SESSION['mentor']['mentor_surname'] ?></h2>
                            </div>
                            <p>Ваш логин: <?php echo $_SESSION['mentor']['mentor_login'] ?></p> <br>
                            <p>Ваш пароль: <?php echo "*****"//$_SESSION['mentor']['mentor_password'] ?></p> <br>
                            <p>Ваш e-mail: <?php echo $_SESSION['mentor']['mentor_email'] ?></p> <br>
                            <p>Ваша специальность: <?php echo $_SESSION['mentor']['speciality'] ?></p> <br>
                            <p>Ваша дополнительная специальность: <?php echo $_SESSION['mentor']['add_speciality'] ?></p> <br>
                            <p>Ваш опыт преподавания: <?php echo $_SESSION['mentor']['experience'] ?></p> <br>
                            <p>Текущий рейтинг: <?php echo $_SESSION['mentor']['rating'] ?></p> <br>
                            <p>Ваша учёная степень: <?php echo $_SESSION['mentor']['graduation'] ?></p> <br>
                            <p>Формат занятий: <?php echo $_SESSION['mentor']['format'] ?></p> <br>
                            <p>Дни занятий: <?php echo $_SESSION['mentor']['days'] ?></p> <br>
                            <p>Ваш возраст: <?php echo $_SESSION['mentor']['age'] ?></p> <br>

                            <p>Ваши студенты: </p> <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>  
    <?php
    }else{
    //echo "Нет доступа к данной странице";
    //exit("<meta http-equiv='refresh' content='0; url= usercontrol'>");
    //exit();
    }
    ?>
</body>
</html>
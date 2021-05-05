<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аккаунт студента</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/student.css">
</head>
<body>
    <?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>
        <div class="mainAcc">
            <div class="sidebar">
                <!--<h5>Изучаемые курсы:</h5>
                <p><a href="">Основы экономики</a></p>
                <p><a href="">Сбытовая логистика. Основы</a></p>
		<p><a href="">Модель мультипликатора-акселератора</a></p>-->
                <a href="viewInvitations">Приглашения</a> <br>
                <a href="groups">Мои группы</a>
            </div>

            <div class="account">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 greetingBlock">
                            <div class="headerGreeting">
                                <img class="avatar" src="<?php echo $_SESSION['student']['student_avatar'] ?>"> <br>
                                <h2 class="greeting">Добро пожаловать, <?php echo $_SESSION['student']['student_first_name'] . " " . $_SESSION['student']['student_surname'] ?></h2>
                            </div>
                            <p>Ваш логин: <?php echo $_SESSION['student']['student_login'] ?></p> <br>
                            <p>Ваш пароль: <?php echo "*****"//$_SESSION['student']['student_password'] ?></p> <br>
                            <p>Ваш e-mail: <?php echo $_SESSION['student']['student_email'] ?></p> <br>
                            <p>Ваши менторы: </p> <br>
                            <p>Количество сертификатов: </p> <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>  
    <?php
    }else{
    echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/users.css">
    <title>Добавить пользователя</title>
</head>
<body>
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>

    <div>
        <div>
        <p>Символом * отмечены поля, обязательные для заполнения</p>
        <div class="regBlock d-flex justify-content-center">
            <form class="regForm" action="#" method="post" enctype ="multipart/form-data">
                <label>Введите имя*:</label> <br>
                <input type="text" name="firstName" required/> <br>
                <label>Введите фамилию*:</label> <br>
                <input type="text" name="surname" required> <br>
                <!--<label>Ваша специализация*:</label> <br>
                <input type="radio" name="userStatus" value="student" id="userStatus1">
                <label for="userStatus1">Студент</label>
                <input type="radio" name="userStatus" value="mentor" id="userStatus2"> 
                <label for="userStatus2">Ментор</label> <br>-->
                <label>Введите e-mail:</label> <br>
                <input type="email" name="email"> <br>
                <label>Добавьте фото профиля:</label> <br>
                <input type="file" name="avatar"> <br>
                <label>Придумайте логин*:</label> <br>
                <input type="text" name="login" required> <br>
                <label>Придумайте пароль*:</label> <br>
                <input type="password" name="password" required> <br>
                <label>Подтвердите пароль*:</label> <br>
                <input type="password" name="confirmPassword" required> <br>
                <input class="btn" type="submit" name="submit" value="Зарегистрировать">
                <?php 
                if(isset($_SESSION['regErrorStack'])){
                    
                    foreach($_SESSION['regErrorStack'] as $error){
                        echo "<p>" . $error . "</p> <br>";        
                    }
                    unset($_SESSION['regErrorStack']);
                }

                /*if($_SESSION['regErrorStack'] == NULL){
                    echo "<p> Вы были успешно зарегистрированы </p>";
                }*/
                ?>
            </form>
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
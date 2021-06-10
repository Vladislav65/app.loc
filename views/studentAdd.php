<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/users.css">
    <link rel="stylesheet" href="../templates/css/reg.css">
    <title>Добавить студента</title>
</head>
<body>
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>

    <div>
        <p class="regDescr" style="text-align:center">Символом * отмечены поля, обязательные для заполнения</p>
        <div class="regBlock d-flex justify-content-center">
            <form class="regForm" action="#" method="post" enctype ="multipart/form-data">
                <label>Введите имя*:</label> <br>
                <input class="inputs" type="text" name="firstName" required/> <br>
                <label>Введите фамилию*:</label> <br>
                <input class="inputs" type="text" name="surname" required> <br>
                <label>Введите e-mail:</label> <br>
                <input class="inputs" type="email" name="email"> <br>
                <label>Добавьте фото профиля:</label> <br>
                <input class="inputs" type="file" name="avatar"> <br>
                <label>Придумайте логин*:</label> <br>
                <input class="inputs" type="text" name="login" required> <br>
                <label>Придумайте пароль*:</label> <br>
                <input class="inputs" type="password" name="password" required> <br>
                <label>Подтвердите пароль*:</label> <br>
                <input class="inputs" type="password" name="confirmPassword" required> <br>
                <input class="btn" type="submit" name="submit" value="Зарегистрировать">
                <?php 
                if(isset($_SESSION['regErrorStack'])){
                    foreach($_SESSION['regErrorStack'] as $error){
                        echo "<p>" . $error . "</p> <br>";        
                    }
                    unset($_SESSION['regErrorStack']);
                }

                ?>
            </form>
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
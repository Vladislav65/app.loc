<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница регистрации</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/reg.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="regSection">
        <h3>Добро пожаловать на страницу регистрации!</h3>
        <p class="regDescr">Символом * отмечены поля, обязательные для заполнения</p>
        <div class="regBlock d-flex justify-content-center">
            <form class="regForm" action="#" method="post" enctype ="multipart/form-data">
                <label>Вы регистрируетесь как*:</label> <br>
                <input type="radio" name="status" value="student"> Студент 
                <input type="radio" name="status" value="mentor"> Ментор <br>
                <label>Введите имя*:</label> <br>
                <input class="inputs" type="text" name="firstName" required/> <br>
                <label>Введите фамилию*:</label> <br>
                <input class="inputs" type="text" name="surname" required> <br>
                <!--<label>Ваша специализация*:</label> <br>
                <input type="radio" name="userStatus" value="student" id="userStatus1">
                <label for="userStatus1">Студент</label>
                <input type="radio" name="userStatus" value="mentor" id="userStatus2"> 
                <label for="userStatus2">Ментор</label> <br>-->
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
                <input class="btn" type="submit" name="submit" value="Зарегистрироваться">
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

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
</body>
</html>
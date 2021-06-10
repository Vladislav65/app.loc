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
        <?php 
            if(!(empty($_SESSION['regErrorStack']))){
                    
                foreach($_SESSION['regErrorStack'] as $error){
                    echo "<p>" . $error . "</p> <br>";        
                }
                unset($_SESSION['regErrorStack']);
            }else if(empty($_SESSION['regErrorStack']) && isset($_POST['submit'])){
                echo "<p>Вы были успешно зарегистрированы</p>";
            }
        ?>
        <div class="regBlock d-flex justify-content-center">
            <form class="regForm" action="#" method="post" enctype ="multipart/form-data">
                <label>Вы регистрируетесь как*:</label> <br>
                <input type="radio" name="status" value="student"> Студент 
                <input type="radio" name="status" value="mentor"> Ментор <br>
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
                <input class="btn" type="submit" name="submit" value="Зарегистрироваться">
            </form>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
</body>
</html>
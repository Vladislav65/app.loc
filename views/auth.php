<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница авторизации</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/auth.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="authSection">
        <h3 class="authTitle">Добро пожаловать на страницу авторизации!</h3>
            <?php
                if(isset($_SESSION['authErrorStack'])){
                    echo "<p>" . $_SESSION['authErrorStack'] . "</p>"; 
                    unset($_SESSION['authErrorStack']);
                }
            ?>
        <p class="authDescr">Введите данные для входа</p>
        <div class="authBlock d-flex justify-content-center">
            <form action="#" method="POST">
                <label>Введите логин:</label> <br>
                <input class="inputs" type="text" name="login" required> <br>
                <label>Введите пароль:</label> <br>
                <input class="inputs" type="password" name="password" required> <br>
                <input style="margin-top:6%" type="checkbox" name="adminCheck" >
                <label style="color: black;
                              text-shadow: 1px 1px 2px, 0 0 0.5em red;">Войти как администратор</label> <br>
                <input class="btn" style="margin-top:2.5%" type="submit" name="auth" value="Войти в аккаунт">
            </form>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>   
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О портале</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/about.css">
</head>
<body>
    <?php
    if(isset($_SESSION['mentor'])){
        include SITE_PATH . DS . "components" . DS . "MentorHeader.php";
    }else{
        include SITE_PATH . DS . "components" . DS . "Header.php";
    }
    ?>
    
    <div class="aboutSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="aboutTitle">Обучающий портал по экономике и логистике</h3>
                    <p class="content"> Добро пожаловать в руководство пользователя портала!
                    Тут Вы найдёте подробное описание функций студента и сможете стать уверенным пользователем системы.
                    Первый шаг для использования - регистрация <img src="templates/images/regScreen.jpg" class="regScreen"><br>
                    Символом * отмечены поля, обязательные для заполнения. В случае если Вы уже имеете аккаунт - авторизуйтесь
                    <img src="templates/images/authScreen.jpg" class="authScreen"> <br>
                    Аккаунт пользователя выглядит следующим образом: <img class="studentScreen" src="templates/images/studentScreen.jpg" > <br>
                    После входа в аккаунт Вам доступны: курсы, которые Вы можете брать на изучение. В курсах содержатся темы занятий и тесты.
                    

                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
</body>
</html>
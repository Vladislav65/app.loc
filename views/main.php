<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>
    
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pageText">
                    <h2>Добро пожаловать на обучающий портал по экономике и логистике</h2>
                    <p class="descr">Обучайтесь различным дисциплинам вместе с нами!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 student">
                    <div class="studentHeader">
                        <img class="studentImg" src="../templates/images/student.jpg" />
                        <h5>Вы студент и хотите обучиться экономике и логистике?</h5> 
                    </div>
                    <p class="studentDescr">Вы можете сделать это грамотно.
                        Зарегистрируйтесь на портале и получите доступ ко всем материалам. Вы сможете выбрать
                        интересующий Вас курс и подобрать ментора, который будет проводить обучение. Функционал
                        портала подразумевает множество полезных и удобных возможностей для эффективного обучения
                        <a href="userR">Зарегистрироваться</a>
                    </p>
                </div>

                <div class="col-md-6 mentor">
                    <div class="mentorHeader">
                        <img class="mentorImg" src="../templates/images/mentor.jpg" />
                        <h5>Вы ментор и хотите найти учеников?</h5> 
                    </div>
                    <p class="mentorDescr">Данный портал может помочь. Зарегистровавшись, Вы получаете возможность
                        набирать студентов по различным дисциплинам и проводить обучение дистанционно, используя
                        возможности и ресурсы портала. Принимайте заявки от студентов, указывайте информацию о себе.
                        Используя возможности системы, Вы можете принимать заявки от студентов, отсеивать неподходящие
                        формировать ориентировочную стоимость занятий и пользоватья другими полезными функциями.
                        
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
</body>
</html>
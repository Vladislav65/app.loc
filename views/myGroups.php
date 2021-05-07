<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать группу</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/student.css">
    <link rel="stylesheet" href="../templates/css/courseAdmin.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "MentorHeader.php" ?>
        <div class="mainAcc">
            <div class="sidebar"></div>
            <div class="account">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            // тут будут блоки с группами
                            foreach($groups as $key => $value){
                            ?>
                            <div class="group">
                                <p>Название: <?php echo $value['name']; ?></p> 
                                <?php 
                                        if($value['speciality'] == 'economics'){
                                    ?>
                                            <p>Дисциплина: Экономика</p>
                                    <?php
                                        }else{
                                    ?>
                                            <p>Дисциплина: Логистика</p>
                                    <?php
                                        }
                                    ?>
                                <p>Специализация: <?php echo $value['add_speciality']; ?></p>
                                <p>Количество студентов: <?php echo $value['students_num']; ?></p>
                                <?php 
                                        if($value['status'] == 'opened'){
                                    ?>
                                            <p>Доступ: Открытая</p>
                                    <?php
                                        }else{
                                    ?>
                                            <p>Доступ: Закрытая</p>
                                    <?php
                                        }
                                ?>
                                <p><a href="inviteStudents<?php echo $value["id"] ?>"><img class="topicPlusIcon" src="templates/images/topicPlusIcon.jpg" /></a> Пригласить студентов</p>
                                <p><a href="mentorCourseAdd<?php echo $value["id"] ?>"><img class="topicPlusIcon" src="templates/images/redPlusIcon.jpg" /></a> Добавить курс</p> <br>
                                <p><a href="manageGroup<?php echo $value['id'] ?>">Управление группой</a></p>
                            </div>
                            <?php
                            }
                            ?>
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
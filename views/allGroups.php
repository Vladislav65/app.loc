<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступные группы</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список курсов</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/courses.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "mentorHeader.php" ?>

    <div class="coursesSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 coursesCol">
                    <h3>Доступные группы:</h3>
                    <?php 
                        foreach($groupsList as $group){
                    ?>
                        <div class="group">
                            <div class="groupHeader">
                                <div class="groupTitle">
                                    <h4><?php echo $group['name']; ?></h4>
                                    <p>Руководитель: <a href=mentors<?php echo (int) $group['owner']; ?>><?php echo $group['owner_name'] . " " . $group['owner_surname'] ?></a></p>
                                    <p>Дисциплина: <?php echo $group['speciality'] ?></p>
                                    <p>Специализация: <?php echo $group['add_speciality'] ?></p>
                                    <?php
                                        if($group['isMember'] == true){
                                    ?>
                                            <p>Вы являетесь студентом этой группы</p>
                                    <?php
                                        }else{
                                    ?>
                                            <p><a href="enterGroup<?php echo $group['id'] ?>">Вступить в группу</a></p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <p><?php echo $course["course_descr"]; ?></p> 
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
</body>
</html>
</body>
</html>
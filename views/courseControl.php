<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/courses.css">
    <title>Управление курсами</title>
</head>
<body>
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>

    <div class="coursesSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 coursesCol">
                    <h3>Наши курсы:</h3>
                    <?php 
                        foreach($coursesList as $course){
                    ?>
                        <div class="course">
                            <div class="courseHeader">
                                <img class="courseImg" src="<?php echo $course["course_img"]; ?>"> <br>
                                <div class="courseTitle">
                                    <h4><?php echo $course["course_name"]; ?></h4>
                                    <p>Категория курса: <?php echo $course["course_category"]; ?></p>
                                    <p>Продолжительность: <?php echo $course["course_length"]; ?> часов</p>
                                </div>
                            </div>
                            <p><?php echo $course["course_descr"]; ?></p> 

                            <?php if(User::adminIsLogged() == true){ ?>
                            <a href="courseAdmin<?php echo $course["course_id"]; ?>">Подробнее</a>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                        }
                    ?>
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
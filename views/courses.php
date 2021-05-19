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
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

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
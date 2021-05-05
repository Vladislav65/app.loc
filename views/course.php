<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Курс: <?php echo $course["course_name"]; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/course.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="courseMain">
        <div class="courseHeader">
            <img src="<?php echo $course["course_img"]; ?>" class="courseImg"> <br>
            <h4><?php echo $course["course_name"]; ?></h4>
            <p>Категория курса: <?php echo $course["course_category"] ?></p>
            <p>Длительность: <?php echo $course["course_length"]; ?> часов</p>
            <a href="coursesS<?php echo $course["course_id"]; ?>">Приступить к изучению</a>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать курс</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/courseAdd.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "mentorHeader.php"; ?>

    <div class="addCourseMain">
        <h4 style="text-align: center">Редактирование курса</h4>
        <div class="courseAddSection d-flex justify-content-center"> 
            <form action="#" method="post" enctype="multipart/form-data">
                <label>Название курса:</label> <br>
                <input value="<?php echo $oldData['course_name']; ?>" type="text" name="courseName"> <br>
                <label>Фото курса:</label> <br>
                <input type="file" name="courseImage"> <br>
                <label>Категория курса:</label> <br>
                <input type="radio" name="courseCategory" value="Экономика" > Экономика
                <input type="radio" name="courseCategory" value="Логистика" > Логистика <br> <br>
                <label>Длительность курса (в часах):</label> <br>
                <input value="<?php echo $oldData['course_length']; ?>" type="number" name="length" min="0" max="300"> <br>
                <label>Описание курса:</label> <br>
                <textarea name="descr" rows="10" cols="45" style="resize: none;"><?php echo $oldData['course_descr']; ?></textarea><br>
                <input class="btn" style="margin-left: 100px; margin-bottom: 30px" type="submit" name="updateCourse" value="Обновить курс"> 
            </form>
            <p>
            <?php
                echo $courseAddResult;
            ?>
            </p>
        </div>
    </div>
    <?php include SITE_PATH . DS . "components" . DS . "footer.php" ?>    
    <?php
    }else{
        echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить новый курс</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/courseAdd.css">
</head>
<body>
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>
    <?php }else if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "mentorHeader.php"; } ?>

    <?php if(isset($_SESSION['admin']) || isset($_SESSION['mentor'])){ ?>
    <div class="addCourseMain">
        <h4 style="text-align: center">Добавление нового курса</h4>
        <div class="courseAddSection d-flex justify-content-center"> 
            <form action="#" method="post" enctype="multipart/form-data">
                <label>Введите название курса:</label> <br>
                <input type="text" name="courseName"> <br>
                <label>Добавьте фото курса:</label> <br>
                <input type="file" name="courseImage"> <br>
                <label>Укажите категорию курса:</label> <br>
                <input type="radio" name="courseCategory" value="Экономика" > Экономика
                <input type="radio" name="courseCategory" value="Логистика" > Логистика <br> <br>
                <label>Укажите длительность курса (в часах):</label> <br>
                <input type="number" name="length" min="0" max="300"> <br>
                <label>Напишите описание курса:</label> <br>
                <textarea name="descr" rows="10" cols="45" style="resize: none;"></textarea><br>
                <input class="btn" style="margin-left: 100px; margin-bottom: 30px" type="submit" name="courseAdd" value="Добавить курс"> 
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
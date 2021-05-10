<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить тему </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/topicAdd.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "mentorHeader.php" ?>

    <div class="topicMain" style="text-align: center;">
    <h3>Добавление новой темы</h3> 
        <form action="#" method="post" enctype="multipart/form-data">
            <label>Введите название темы:</label> <br>
            <input type="text" name="topicTitle"> <br> <br>
            <label>Добавьте фото темы:</label> <br>
            <input type="file" name="topicImage"> <br> <br>
            <label>Напечатайте содержимое темы:</label> <br>
            <textarea name="topic" rows="20" cols="65" style="resize: none;"></textarea><br>
            <input class="btn" type="submit" name="topicAdd" value="Добавить тему"> 
        </form>
    </div>
    <?php
            echo $topicAddResult;
    ?>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>    
    <?php
    }else{
    echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
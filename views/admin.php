<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/admin.css">
    <title>Система администрирования</title>
</head>
<body>
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>
    <div class="admin">
        <h2>Аккаунт администратора</h2>
        <h3>Статистика портала:</h3> 
        <a href="savefile">Сохранить в файл</a> <br>
        <?php 
            echo $fileResult;
        ?>
        <p>Количество студентов: <?php echo $statistics["studentsNum"] ?></p>
        <p>Количество менторов: <?php echo $statistics["mentorsNum"] ?></p>
        <p>Количество курсов: <?php echo $statistics["coursesNum"] ?></p>
        <p>Общее количество тем: <?php echo $statistics["topicsNum"] ?></p>
        <p>Общее количество тестов: <?php echo $statistics["testsNum"] ?></p>
        <p>Самые рейтинговые менторы: <br>
        <?php 
            foreach($statistics["ratedMentors"] as $mentor){
                echo "<br>" . $mentor["mentor_first_name"] . " " . $mentor["mentor_surname"] . "<br>";
            }    
        ?>
        </p>
    </div>
    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
    <?php
    }else{
    echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тема:</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/topic.css">
</head>
<body>
    <?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <h2 style="text-align: center;">Тема:</h2>
    <div class="topic" style="text-align: center;">
        <div class="topicHeader">
            <p><?php echo $topic["topic_title"]; ?></p>
            <p><?php echo $topic["topic_content"]; ?></p>
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
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

    <div class="topic">
        <div class="topicHeader">
            <h3 style="text-align: center;"><?php echo $topic["topic_title"]; ?></h3>
            <?php 
                if($fileFlag == true){
            ?>
                    <h5>Загруженный файл:</h5>
                    <img src="/templates/images/pdfIcon.jpg" style="width: 30px; height: 30px">
                    <a href="<?php echo $topic['file'] ?>" target="_blank"><?php echo $fileName ?></a>
            <?php
                }
            ?>
            <p><?php echo $topic["topic_content"]; ?></p>
            <?php if($isLearned == true){ ?>
                <p><a href="learned<?php echo $topic['topic_id'] ?>">Отметить как изученное</a></p>
            <?php }else{ ?>
                <p>Изучено</p>
            <?php }?>
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
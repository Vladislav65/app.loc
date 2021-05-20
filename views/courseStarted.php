<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вы начали курс</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/courseStarted.css">
</head>
<body>
    <?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="courseMaterials">
    <h4>Темы курса:</h4>
        <div class="courseTopics">
        <?php
            foreach($topics as $topic){ 
        ?>
            <div class="courseTopic" style="display:flex;">
                <div><img src="<?php echo $topic["topic_img"] ?>" class="topicImg" style="width:280px; heigth:160px"></div>
                <div>
                    <h5><?php echo $topic["topic_title"]; ?></h5>
                    <p><?php echo mb_substr($topic['topic_content'], 0, 310, 'utf-8'); ?></p>
                    <a href="topic<?php echo $topic["topic_id"]; ?>">Изучить</a>
                </div>
            </div>
        <?php 
        } 
        ?>
        </div>

        <h4>Тесты курса:</h4>
        <div class="courseTests">
            <?php
                foreach($tests as $test){
            ?>
                <div class="courseTest">
                    <div>
                        <h5><?php echo $test["title"]; ?></h5>
                        <p><?php echo $test["id"]; ?></p>
                        <a href="dotest<?php echo $test["id"]; ?>">Пройти тест</a>
                    </div>
                </div>
            <?php
                }
            ?>
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
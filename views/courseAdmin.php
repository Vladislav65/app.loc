<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администрирование курса</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/courseAdmin.css">
    <link rel="stylesheet" href="../templates/css/courseStarted.css">
</head>
<body>
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>

    <div class="courseMaterials">
    <h4>Темы курса:</h4>
    <p><a href="topicAdd<?php echo $course["course_id"] ?>"><img class="topicPlusIcon" src="templates/images/topicPlusIcon.jpg" /></a> Добавить тему</p>
        <div class="courseTopics">
        <?php foreach($topics as $topic){ ?>
            <div class="courseTopic">
                <div><img src="<?php echo $topic["topic_img"] ?>" class="topicImg" style="width:280px; heigth:160px"></div>
                <div>
                    <h5><?php echo $topic["topic_title"]; ?></h5>
                    <p><?php echo mb_substr($topic['topic_content'], 0, 310, 'utf-8'); ?></p>
                </div>
            </div>
        <?php 
        } 
        ?>
        </div>

        <h4 style="margin-top: 50px;">Тесты курса:</h4>
        <p><a href="testAdd<?php echo $course["course_id"] ?>"><img class="topicPlusIcon" src="templates/images/topicPlusIcon.jpg" /></a> Добавить тест</p>
        <div class="courseTests">
        <?php
            foreach($tests as $test){
        ?>
            <div class="courseTest">
                <div>
                    <h5><?php echo $test["test_title"]; ?></h5>
                    <p><?php echo $test["test_id"]; ?></p>
                </div>
            </div>
        <?php
            }
        ?>
        </div>     
        <p style="text-align: center; margin-top:30px"><a href="deleteCourse<?php echo $course["course_id"] ?>"><img class="deleteIcon" src="templates/images/deleteIcon.jpg" /></a> Удалить курс</p>    
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
    <?php
    }else{
    echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
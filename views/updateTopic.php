<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновить тему </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet" />
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet" />
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="../templates/js/Script.js"></script>
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/topicAdd.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "mentorHeader.php" ?>

    <div class="topicMain"> <!-- style="text-align: center; -->
    <h3>Обновление темы</h3> 
        <form action="#" method="post" enctype="multipart/form-data">
            <label>Обновить название темы:</label> <br>
            <input type="text" name="topicTitle" value="<?php echo $topic['topic_title'] ?>"> <br> <br>
            <label>Обновить фото темы:</label> <br>
            <input type="file" name="topicImage"> <br> <br>
            <label>Прикрепить файл с темой:</label> <br>
            <input type="file" name="file"> <br> <br>
            <label>Обновить содержимое темы:</label> <br>
            <textarea id="addTopic" name="topic" rows="20" cols="65" style="resize: none; text-align: center;"><?php echo $topic['topic_content']; ?></textarea><br>
            <input class="btn" type="submit" name="updateTopic" value="Обновить тему"> 
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
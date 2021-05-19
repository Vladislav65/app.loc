<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отправить сообщение</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/topicAdd.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "mentorHeader.php" ?>

    <div class="topicMain"> <!-- style="text-align: center; -->
    <h3 style="text-align: center">Сообщение студенту</h3> 
        <form action="#" method="post" enctype="multipart/form-data" style="text-align: center">
            <label>Введите заголовок сообщения:</label> <br>
            <input type="text" name="messageTitle"> <br> <br>
            <label>Напечатайте сообщение:</label> <br>
            <textarea id="addTopic" name="message" rows="20" cols="65" style="resize: none;"></textarea><br>
            <?php if($messageType == 'email'){
            ?>
                <input class="btn" type="submit" name="emailBtn" value="Отправить email">
            <?php
            }else if($messageType == 'chat'){
            ?>
                <input class="btn" type="submit" name="chatBtn" value="Отправить сообщение">
            <?php
            }
            ?>
             
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
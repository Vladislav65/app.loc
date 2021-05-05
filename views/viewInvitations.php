<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/users.css">
    <title>Приглашения в группы</title>
</head>
<body>
<?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>
        <div class="invitations">
            <h3>Приглашения в группы менторов:</h3>
                <?php
                    if(isset($result)){
                ?>
                        <p><?php echo $result; ?></p>                        
                <?php
                    }else{
                        foreach($invitationsList as $invitation){
                ?>
                        <div class="invitation">
                            <p>Название группы: <?php echo $invitation['name']; ?></p>
                            <p>Приглашающий ментор: <a href=mentors<?php echo (int) $invitation['owner']; ?>><?php echo $invitation['mentor_login']; ?></a></p>
                            <p>Дисциплина: <?php 
                                if($invitation['speciality'] == 'logistics'){
                                    echo 'Логистика';
                                }else{
                                    echo 'Экономика';
                                }
                             ?></p>
                            <p>Специализация: <?php echo $invitation['add_speciality']; ?></p>
                            <p>Статус: <?php
                                if($invitation['status'] == 'opened'){
                                    echo 'Открытая';
                                }else{
                                    echo 'По приглашению';
                                }
                            ?></p>    
                            <a href="join<?php echo $invitation['invitation_id'] ?>">Вступить</a> <br>
                            <a href="decline<?php echo $invitation['invitation_id'] ?>">Отклонить</a> <br>
                        </div>
                <?php
                        }
                    }            
                ?>           
        </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>  
    <?php
    }else{
    echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
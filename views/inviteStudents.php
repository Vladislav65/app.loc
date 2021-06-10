<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пригласить студентов</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/mentors.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "MentorHeader.php" ?>

    <div class="mentorsSection">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mentorsCol">
                    <h3>Студенты на портале:</h3>
                    <?php
                        if($result == 'В данный момент на портале нет студентов'){
                            echo $result;
                        }else{
                            foreach($students as $student){
                    ?>
                                <img class='student_img' src="<?php echo $student['student_avatar'] ?>" alt="">
                                <p>Имя: <?php echo $student['student_first_name'] ?></p>
                                <p>Фамилия: <?php echo $student['student_surname'] ?></p>
                                <p>Email: <?php echo $student['student_email'] ?></p>
                                <p>Логин: <?php echo $student['student_login'] ?></p>
                                <a href="sendInvitation<?php echo $student['student_id'] ?>">Пригласить</a> <br>
                    <?php
                            }
                            if(isset($invitationResult)){
                    ?>
                                <p><?php echo $invitationResult; ?></p>
                    <?php                            
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
</body>
</html>
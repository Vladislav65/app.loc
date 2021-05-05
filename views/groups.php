<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои группы</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/student.css">
    <link rel="stylesheet" href="../templates/css/courseAdmin.css">
</head>
<body>
    <?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>
        <div class="mainAcc">
            <div class="sidebar"></div>
            <div class="account">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                foreach($fullGroups as $group){
                            ?>
                                <div class="groupBlock">
                                    <p>Название: <?php echo $group['name'] ?></p>
                                    <p>Дисциплина: <?php echo $group['speciality'] ?></p>
                                    <p>Специализация: <?php echo $group['add_speciality'] ?></p>
                                    <?php 
                                        if($group['status'] == 'opened'){
                                    ?>
                                            <p>Открытая</p>
                                    <?php
                                        }else{
                                    ?>
                                            <p>Закрытая</p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
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
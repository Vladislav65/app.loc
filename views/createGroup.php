<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать группу</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/student.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "MentorHeader.php" ?>
        <div class="mainAcc">
            <div class="sidebar"></div>

            <div class="account">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="#" method="POST">
                            <label>1. Название группы*:</label> <br>
                            <input type="text" name="groupName" required/> <br>
                            <label>2. Выберите дисциплину группы:</label> <br>
                            <input type="radio" name="speciality" value="logistics" id="speciality1">
                            <label for="userStatus1">Логистика</label>
                            <input type="radio" name="speciality" value="economics" id="speciality2"> 
                            <label for="userStatus2">Экономика</label> <br> <br>
                            <label>3. Выберите дополнительную специализацию: </label> <br>
                            <select name="eDirections">
                                <option value="Основы экономики">Основы экономики</option>
                                <option value="Микроэкономика">Микроэкономика</option>
                                <option value="Макроэкономика">Макроэкономика</option>
                                <option value="Мировая экономика">Мировая экономика</option>
                            </select>

                            <select name="lDirections">
                                <option value="Основы логистики">Основы логистики</option>
                                <option value="Закупочная логистика">Закупочная логистика</option>
                                <option value="Сбытовая логистика">Сбытовая логистика</option>
                                <option value="Транспортная логистика">Транспортная логистика</option>
                                <option value="Таможенная логистика">Таможенная логистика</option>
                                <option value="Логистика запасов">Логистика запасов</option>
                                <option value="Складская логистика">Складская логистика</option>
                                <option value="Информационная логистика">Информационная логистика</option>
                                <option value="Комплексная логистика">Комплексная логистика</option>
                            </select> <br> <br>

                            <label>4. Введите статус группы:</label> <br>
                            <input type="radio" name="status" value="closed"> По приглашению <br>
                            <input type="radio" name="status" value="opened"> Открытая <br>
                            <input class="btn" type="submit" name="createGroup" value="Создать группу">                            
                            </form>                            
                        </div>
                        <?php 
                        if(isset($result)){
                            echo $result;
                        }  
                        ?>
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
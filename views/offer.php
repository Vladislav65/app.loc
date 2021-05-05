<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сделать заявку</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/offer.css">
</head>
<body>
    <?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>
    
    <div class="offerBlock d-flex justify-content-center">
        <form action="#" method="POST">
            <label>1.Введите искомую специальность:</label> <br>
            <input type="radio" name="speciality" value="Экономика"> Экономика
            <input type="radio" name="speciality" value="Логистика"> Логистика <br> <br>

            <label>2.Выберите желаемые направления изучения: </label> <br>
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
                    <option value="Информационная логистика">Информационная логистика</option>
                    <option value="Комплексная логистика">Комплексная логистика</option>
                </select> <br> <br>

            <label>3.Выберите формат обучения:</label> <br>
                <input type="checkbox" name="format[]" value="Дистанционное"> Дистанционное <br>
                <input type="checkbox" name="format[]" value="Очное"> Очное <br> <br>

            <label>4.Выберите дни занятий</label> <br>
                <input type="checkbox" name="days[]" value="Понедельник"> Понедельник <br>
                    <input type="checkbox" name="days[]" value="Вторник"> Вторник <br>
                    <input type="checkbox" name="days[]" value="Среда"> Среда <br>
                    <input type="checkbox" name="days[]" value="Четверг"> Четверг <br>
                    <input type="checkbox" name="days[]" value="Пятница"> Пятница <br>
                    <input type="checkbox" name="days[]" value="Суббота"> Суббота <br>
                    <input type="checkbox" name="days[]" value="Воскресенье"> Воскресенье <br> <br>
            <label>5.Ваш опыт изучения дисциплины (лет):</label> <br>
                <input type="number" name="experience"> <br>
            <input class="btn" style="margin-bottom: 30px;" type="submit" name="offer" value="Отправить заявку" />
        </form>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>  
    <?php
    }else{
    echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
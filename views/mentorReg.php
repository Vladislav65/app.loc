<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завершение регистрации</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/reg.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="regSection">
        <h3>Добро пожаловать! Дополните данные о себе</h3>
        <p>Символом * отмечены поля, обязательные для заполнения</p>
        <div class="regBlock d-flex justify-content-center">
            <form class="regForm" action="#" method="post">
                <label>1.Выберите Вашу специализацию*:</label> <br>
                <input type="radio" name="speciality" value="logistics" id="userStatus1">
                <label for="userStatus1">Логистика</label>
                <input type="radio" name="speciality" value="economics" id="userStatus2"> 
                <label for="userStatus2">Экономика</label> <br> <br>
                <label>2.Выберите дополнительную специализацию: </label> <br>
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

                <label>3.Укажите свой опыт преподавания в годах (если имеется):</label> <br>
                <input type="number" name="experience" min = "3"> <br>

                <label>4.Укажите Вашу учёную степень:</label> <br>
                <select name="graduation">
                    <option>Бакалавр</option>
                    <option>Магистр</option>
                    <option>Кандидат наук</option>
                    <option>Доктор наук</option>
                </select> <br> <br>

                <label>5.Установите формат обучения:</label> <br>
                <input type="checkbox" name="format[]" value="Дистанционное"> Дистанционное <br>
                <input type="checkbox" name="format[]" value="Очное"> Очное <br> <br>

                <label>6.Укажите дни проведения занятий:</label> <br>
                <input type="checkbox" name="days[]" value="Понедельник"> Понедельник <br>
                <input type="checkbox" name="days[]" value="Вторник"> Вторник <br>
                <input type="checkbox" name="days[]" value="Среда"> Среда <br>
                <input type="checkbox" name="days[]" value="Четверг"> Четверг <br>
                <input type="checkbox" name="days[]" value="Пятница"> Пятница <br>
                <input type="checkbox" name="days[]" value="Суббота"> Суббота <br>
                <input type="checkbox" name="days[]" value="Воскресенье"> Воскресенье <br> <br>

                <label>7.Ваш возраст:</label> <br>
                <input type="number" name="age" min="23"> <br>

                <input type="submit" name="mentorReg" value="Окончить регистрацию">
            </form>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>
</body>
</html>

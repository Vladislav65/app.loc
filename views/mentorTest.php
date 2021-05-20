<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест на подбор ментора</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/mentorTest.css">
</head>
<body>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="mentorTestMain">
        <h4>Данный тест поможет Вам подобрать ментора для эффективного обучения исходя из уровня, требований и других параметров</h4>
        <div class="mentorTestForm d-flex justify-content-center">
            <form action="#" method="POST">
                <label>1.Выберите желаемую сферу изучения: </label> <br>
                <input type="radio" name="sphere" value="Экономика"> Экономика
                <input type="radio" name="sphere" value="Логистика"> Логистика <br> <br>
                
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
                    <option value="Складская логистика">Складская логистика</option>
                    <option value="Информационная логистика">Информационная логистика</option>
                    <option value="Комплексная логистика">Комплексная логистика</option>
                </select> <br> <br>

                <label>3.Ваш опыт изучения дисциплины (лет): </label> <br>
                <input type="number" name="experience"> <br> <br>

                <label>4.Требуемая учёная степень ментора:</label> <br>
                <select name="graduation">
                    <option>Бакалавр</option>
                    <option>Магистр</option>
                    <option>Кандидат наук</option>
                    <option>Доктор наук</option>
                </select> <br> <br>

                <label>5.Желаемый формат обучения:</label> <br>
                <input type="checkbox" name="format[]" value="Дистанционное"> Дистанционное <br>
                <input type="checkbox" name="format[]" value="Очное"> Очное <br> <br> 

                <label>6.Выберите желаемые дни занятий:</label> <br>
                <input type="checkbox" name="days[]" value="Понедельник"> Понедельник <br>
                <input type="checkbox" name="days[]" value="Вторник"> Вторник <br>
                <input type="checkbox" name="days[]" value="Среда"> Среда <br>
                <input type="checkbox" name="days[]" value="Четверг"> Четверг <br>
                <input type="checkbox" name="days[]" value="Пятница"> Пятница <br>
                <input type="checkbox" name="days[]" value="Суббота"> Суббота <br>
                <input type="checkbox" name="days[]" value="Воскресенье"> Воскресенье <br> <br>

                <label>7.Выберите возраст ментора:</label> <br>
                <input type="radio" name="age" value="23-30"> 23-30 <br>
                <input type="radio" name="age" value="30-40"> 30-40 <br>
                <input type="radio" name="age" value="40-50"> 40-50 <br>
                <input type="radio" name="age" value="50 и старше"> 50 и старше <br> <br>

                <label>8.Введите желаемый ориентировочный рейтинг ментора:</label> <br>
                <input type="number" name="rating" min="0" max="100" step="10"> <br> 
        
                <input class="btn" type="submit" name="mentorTest" value="Отправить">
            </form>
        </div>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>

    <!-- Скрипт, отвечающий за ползунок -->
    <!--<script>
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;

        slider.oninput = function() {
        output.innerHTML = this.value;
        }
    </script>-->
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать тест</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/createTest.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "mentorHeader.php" ?>

    <div>
        <div class="test" style="text-align: center">
            <h4>Форма добавления теста:</h4>
            <form action="#" method="POST">
                <label>Введите название теста:</label> <br>
                <input type="text" name="testTitle"> <br>
                <!-- Подключить сложность теста -->
                <div class="questions">
                    <div class="question">
                        <label>Текст вопроса №1:</label> <br>
                        <input type="text" name="question1"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant11"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant12"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant13"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant14"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct1" value="1"> 1
                        <input type="radio" name="correct1" value="2"> 2
                        <input type="radio" name="correct1" value="3"> 3
                        <input type="radio" name="correct1" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №2:</label> <br>
                        <input type="text" name="question2"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant21"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant22"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant23"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant24"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct2" value="1"> 1
                        <input type="radio" name="correct2" value="2"> 2
                        <input type="radio" name="correct2" value="3"> 3
                        <input type="radio" name="correct2" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №3:</label> <br>
                        <input type="text" name="question3"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant31"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant32"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant33"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant34"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct3" value="1"> 1
                        <input type="radio" name="correct3" value="2"> 2
                        <input type="radio" name="correct3" value="3"> 3
                        <input type="radio" name="correct3" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №4:</label> <br>
                        <input type="text" name="question4"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant41"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant42"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant43"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant44"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct4" value="1"> 1
                        <input type="radio" name="correct4" value="2"> 2
                        <input type="radio" name="correct4" value="3"> 3
                        <input type="radio" name="correct4" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №5:</label> <br>
                        <input type="text" name="question5"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant51"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant52"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant53"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant54"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct5" value="1"> 1
                        <input type="radio" name="correct5" value="2"> 2
                        <input type="radio" name="correct5" value="3"> 3
                        <input type="radio" name="correct5" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №6:</label> <br>
                        <input type="text" name="question6"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant61"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant62"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant63"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant64"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct6" value="1"> 1
                        <input type="radio" name="correct6" value="2"> 2
                        <input type="radio" name="correct6" value="3"> 3
                        <input type="radio" name="correct6" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №7:</label> <br>
                        <input type="text" name="question7"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant71"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant72"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant73"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant74"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct7" value="1"> 1
                        <input type="radio" name="correct7" value="2"> 2
                        <input type="radio" name="correct7" value="3"> 3
                        <input type="radio" name="correct7" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №8:</label> <br>
                        <input type="text" name="question8"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant81"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant82"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant83"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant84"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct8" value="1"> 1
                        <input type="radio" name="correct8" value="2"> 2
                        <input type="radio" name="correct8" value="3"> 3
                        <input type="radio" name="correct8" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №9:</label> <br>
                        <input type="text" name="question9"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant91"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant92"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant93"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant94"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct9" value="1"> 1
                        <input type="radio" name="correct9" value="2"> 2
                        <input type="radio" name="correct9" value="3"> 3
                        <input type="radio" name="correct9" value="4"> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №10:</label> <br>
                        <input type="text" name="question10"> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant101"> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant102"> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant103"> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant104"> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct10" value="1"> 1
                        <input type="radio" name="correct10" value="2"> 2
                        <input type="radio" name="correct10" value="3"> 3
                        <input type="radio" name="correct10" value="4"> 4
                        <br> <label>Выберите статус теста:</label> <br>
                        <label>(По результатам итогового теста выдаются сертификаты)</label> <br>
                        <select name="testStatus">
                            <option>Промежуточный</option>
                            <option>Итоговый</option>
                        </select> <br> <br>
                        <br>
                    </div>

                    <input class="btn" style="margin-top: 10px;" type="submit" name="test" value="Создать тест"> <br>
                </div>
            </form>
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
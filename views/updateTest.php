<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать тест</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/createTest.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "mentorHeader.php" ?>

    <div>
        <div class="test" style="text-align: center">
            <h4>Форма редактирования теста:</h4>
            <form action="#" method="POST">
                <label>Введите название теста:</label> <br>
                <input type="text" name="testTitle" value="<?php echo $testForUpdate['title'] ?>"> <br>
                <div class="questions">
                <?php //foreach($testForUpdate as $key => $value){ ?>
                    <div class="question">
                        <label value="<?php echo $key ?>">Текст вопроса №1:</label> <br>
                        <input type="text" name="question1" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant11" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant12" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant13" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant14" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct1" value="1" required> 1
                        <input type="radio" name="correct1" value="2" required> 2
                        <input type="radio" name="correct1" value="3" required> 3
                        <input type="radio" name="correct1" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №2:</label> <br>
                        <input type="text" name="question2" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant21" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant22" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant23" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant24" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct2" value="1" required> 1
                        <input type="radio" name="correct2" value="2" required> 2
                        <input type="radio" name="correct2" value="3" required> 3
                        <input type="radio" name="correct2" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №3:</label> <br>
                        <input type="text" name="question3" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant31" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant32" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant33" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant34" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct3" value="1" required> 1
                        <input type="radio" name="correct3" value="2" required> 2
                        <input type="radio" name="correct3" value="3" required> 3
                        <input type="radio" name="correct3" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №4:</label> <br>
                        <input type="text" name="question4" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant41" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant42" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant43" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant44" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct4" value="1" required> 1
                        <input type="radio" name="correct4" value="2" required> 2
                        <input type="radio" name="correct4" value="3" required> 3
                        <input type="radio" name="correct4" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №5:</label> <br>
                        <input type="text" name="question5" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant51" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant52" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant53" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant54" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct5" value="1" required> 1
                        <input type="radio" name="correct5" value="2" required> 2
                        <input type="radio" name="correct5" value="3" required> 3
                        <input type="radio" name="correct5" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №6:</label> <br>
                        <input type="text" name="question6" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant61" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant62" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant63" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant64" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct6" value="1" required> 1
                        <input type="radio" name="correct6" value="2" required> 2
                        <input type="radio" name="correct6" value="3" required> 3
                        <input type="radio" name="correct6" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №7:</label> <br>
                        <input type="text" name="question7" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant71" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant72" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant73" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant74" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct7" value="1" required> 1
                        <input type="radio" name="correct7" value="2" required> 2
                        <input type="radio" name="correct7" value="3" required> 3
                        <input type="radio" name="correct7" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №8:</label> <br>
                        <input type="text" name="question8" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant81" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant82" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant83" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant84" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct8" value="1" required> 1
                        <input type="radio" name="correct8" value="2" required> 2
                        <input type="radio" name="correct8" value="3" required> 3
                        <input type="radio" name="correct8" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №9:</label> <br>
                        <input type="text" name="question9" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant91" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant92" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant93" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant94" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct9" value="1" required> 1
                        <input type="radio" name="correct9" value="2" required> 2
                        <input type="radio" name="correct9" value="3" required> 3
                        <input type="radio" name="correct9" value="4" required> 4
                        <br>
                    </div>

                    <div class="question">
                        <label>Текст вопроса №10:</label> <br>
                        <input type="text" name="question10" required> <br>
                        <label>Введите вариант 1:</label> <br>
                        <input type="text" name="variant101" required> <br>
                        <label>Введите вариант 2:</label> <br>
                        <input type="text" name="variant102" required> <br>
                        <label>Введите вариант 3:</label> <br>
                        <input type="text" name="variant103" required> <br>
                        <label>Введите вариант 4:</label> <br>
                        <input type="text" name="variant104" required> <br>
                        <label>Отметьте номер верного варианта:</label> <br>
                        <input type="radio" name="correct10" value="1" required> 1
                        <input type="radio" name="correct10" value="2" required> 2
                        <input type="radio" name="correct10" value="3" required> 3
                        <input type="radio" name="correct10" value="4" required> 4
                        <br> <label>Выберите статус теста:</label> <br>
                        <label>(По результатам итогового теста выдаются сертификаты)</label> <br>
                        <select name="testStatus" required>
                            <option>Промежуточный</option>
                            <option>Итоговый</option>
                        </select> <br> <br>
                        <br>
                        
                    </div>
                <?php //} ?>
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
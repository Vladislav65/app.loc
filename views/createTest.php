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
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>

    <div>
        <div class="test">
            <h4>Форма добавления теста:</h4>
            <form action="#" method="POST">
                <label>Введите название теста:</label> <br>
                <input type="text" name="testTitle"> <br>
                <!-- Подключить сложность теста -->
                <div class="questions">
                    <div class="question1">
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
                        <label>Введите номер верного варианта:</label> <br>
                        <input type="number" name="correct1"> <br>
                    </div>

                    <div class="question2">
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
                        <label>Введите номер верного варианта:</label> <br>
                        <input type="number" name="correct2"> <br>
                        <input class="btn" style="margin-top: 10px;" type="submit" name="test" value="Создать"> <br>
                        <?php 
                            echo $result;
                        ?>
                    </div>

                    <div class="question3">
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
                        <label>Введите номер верного варианта:</label> <br>
                        <input type="number" name="correct3"> <br>
                    </div>
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
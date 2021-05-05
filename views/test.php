<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/test.css">
</head>
<body>
    <?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>

    <div class="testSection">
        <div class="test">
            <h4><?php echo $test["test_title"] ?></h4>
            <form action="#" method="POST">
                <?php
                for($i = 0; $i < sizeof($test["content"]); $i++){
                    echo "<label>" . $test["content"][$i] . "</label> ";
                    if($i == 0 || $i == 5 || $i == 10){
                        echo "<br>";
                    }else if($i >= 1 && $i <= 4){
                        echo "<input type=\"radio\" name=\"question1\"
                              value=\"" . $test["content"][$i] . "\" > <br>";
                    }else if($i >= 6 && $i <= 9){
                        echo "<input type=\"radio\" name=\"question2\"
                              value=\"" . $test["content"][$i] . "\" > <br>";
                    }else if($i >= 11 && $i <= 14){
                        echo "<input type=\"radio\" name=\"question3\"
                              value=\"" . $test["content"][$i] . "\" > <br>";
                    }
                }
                ?>
                <input class="btn" type="submit" name="dotest">
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
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
            <h4><?php echo $test["title"] ?></h4>
            <form action="#" method="POST">
                <?php
                    foreach($test['content'] as $key => $value){
                ?>
                    <label><?php  ?></label> <br>
                    <?php
                        echo $value[0]; 
                        echo "<input type=\"radio\" name=\"question1\"
                        value=\"" . $value[0] . "\" > <br>";

                        echo $value[1]; 
                        echo "<input type=\"radio\" name=\"question2\"
                        value=\"" . $value[1] . "\" > <br>";
                    ?>
                <?php
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
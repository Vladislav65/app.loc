<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат заявки</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/offerResults.css">
</head>
<body>
    <?php if(isset($_SESSION['student'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "Header.php" ?>
    <div class="offerResult">
    <h3>Результаты заявки:</h3>
        <?php
            if(isset($_SESSION['rejectOffer'])){
                echo "Извините, заявка отклонена";
                echo "<div style=\"text-align: center\">";
                echo "<table border=\"3\">";
                    foreach($_SESSION['rejectOffer'] as $reject){
                        echo "<tr>";
                            echo "<td>$reject</td>";
                        echo "</tr>";
                    }
                echo "</table>";
                echo "</div>";

                unset($_SESSION['rejectOffer']);
            }

            if(isset($_SESSION['underConsideration'])){
                echo $_SESSION['underConsideration'];

                unset($_SESSION['underConsideration']);
            }

            if(isset($_SESSION['accepted'])){
                echo $_SESSION['accepted'];

                unset($_SESSION['accepted']);
            }
        ?>
    </div>

    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>  
    <?php
    }else{
    echo "Нет доступа к данной странице";
    }
    ?>
</body>
</html>
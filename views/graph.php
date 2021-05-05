<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Графическая информация</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/graph.css">
</head>
<body>
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>
    <h3 style="text-align: center;">Графическая информация:</h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="barChart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <!--<div class="col-md-1"></div>-->
                <div class="col-md-5">
                    <div class="pieChart-container">
                        <canvas id="pieChart"></canvas>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script>
            var bar = document.getElementById('barChart').getContext('2d');
            var chart = new Chart(bar, {
            
            type: 'bar',

            data: {
                labels: ['Основы экономики',
                         'Микроэкономика',
                         'Макроэкономика',
                         'Мировая экономика',
                         'Основы логистики',
                         'Закупочная логистика',
                         'Сбытовая логистика',
                         'Транспортная логистика',
                         'Таможенная логистика',
                         'Логистика запасов',
                         'Информационная логистика',
                         'Комплексная логистика'],
                datasets: [{
                    label: 'Отношение менторов по доп. специализациям',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?php echo $counters["Основы экономики"] ?>,
                           <?php echo $counters["Микроэкономика"] ?>,
                           <?php echo $counters["Макроэкономика"] ?>,
                           <?php echo $counters["Мировая экономика"] ?>,
                           <?php echo $counters["Основы логистики"] ?>, 
                           <?php echo $counters["Закупочная логистика"] ?>,
                           <?php echo $counters["Сбытовая логистика"] ?>,
                           <?php echo $counters["Транспортная логистика"] ?>,
                           <?php echo $counters["Таможенная логистика"] ?>,
                           <?php echo $counters["Логистика запасов"] ?>,
                           <?php echo $counters["Информационная логистика"] ?>,
                           <?php echo $counters["Комплексная логистика"] ?>
                           ]
                }]
            },

            options: {}
            });

            // PIE CHART
            var pie = document.getElementById('pieChart').getContext('2d');
            var chart = new Chart(pie, {

            type: 'pie',

            data: {
                labels: [
                    '<?php echo array_keys($information["usersNum"])[0] ?>',
                    '<?php echo array_keys($information["usersNum"])[1] ?>'
                ],
                datasets: [{
                    label: 'Соотношение',
                    backgroundColor: ['red', 'green', 'blue'],
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?php echo $information["usersNum"]["Количество студентов"] ?>,
                    <?php echo $information["usersNum"]["Количество менторов"] ?>]
                }]
            },

            options: {}
            });
    </script>
</body>
</html>
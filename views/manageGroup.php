<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление группой</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/student.css">
</head>
<body>
    <?php if(isset($_SESSION['mentor'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "MentorHeader.php" ?>
        <div class="mainAcc">
            <div class="sidebar"></div>
            <div class="account">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Информация группы:</h4>
                            <p>Название: <?php echo $group['name'] ?></p>
                            <p>Дисциплина: <?php echo $group['speciality'] ?></p>
                            <p>Специализация: <?php echo $group['add_speciality'] ?></p>
                            <?php 
                                if($group['status'] == 'opened'){
                            ?>
                                    <p>Доступ: Открытая</p>
                            <?php
                                }else{
                            ?>
                                    <p>Доступ: Закрытая</p>
                            <?php
                                }
                            ?>
                            <p>Количество курсов: <?php echo $group['courses_num'] ?></p>
                            <p>Количество студентов: <?php echo $group['students_num'] ?></p>
                            <h5>Список курсов: </h5>
                            <?php
                                echo "<table border=\"2\">";
                                    echo "<tr>
                                    <td>id студента</td>
                                    <td>Имя студента</td>
                                    <td>Фамилия студента</td>
                                    <td>E-mail студента</td>
                                    <td>Лого курса</td>
                                    <td>Логин студента</td>
                                    <td>Удалить студента</td>
                                    <tr>";

                                    foreach($users["students"] as $student){
                                    echo "<tr>";
                                        echo "<td>" . $student["student_id"] . "</td>";
                                        echo "<td>" . $student["student_first_name"] . "</td>";
                                        echo "<td>" . $student["student_surname"] . "</td>";
                                        echo "<td>" . $student["student_email"] . "</td>";
                                        echo "<td><img class=\"avatar\" src=".$student["student_avatar"]."></td>";
                                        echo "<td>" . $student["student_login"] . "</td>";
                                        echo "<td> <a href=\"delStudent".$student["student_id"]."\"><img class=\"deleteIcon\" src=\"templates/images/deleteIcon.jpg\" /></a></td>";
                                    echo "</tr>";
                                    }
                                echo "</table> <br>";
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php include SITE_PATH . DS . "components" . DS . "Footer.php" ?>  
    <?php
    }else{
    //echo "Нет доступа к данной странице";
    //exit("<meta http-equiv='refresh' content='0; url= usercontrol'>");
    //exit();
    }
    ?>
</body>
</html>
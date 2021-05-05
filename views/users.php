<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/users.css">
    <title>Управление пользователями</title>
</head>
<body>
    <?php if(isset($_SESSION['admin'])){ ?>
    <?php include SITE_PATH . DS . "components" . DS . "adminHeader.php" ?>

    <div class="users">
        <div class="studentsTableBlock">
            <?php
                echo "СТУДЕНТЫ В СИСТЕМЕ:";
                echo "<table border=\"2\">";
                    echo "<tr>
                    <td>id студента</td>
                    <td>Имя студента</td>
                    <td>Фамилия студента</td>
                    <td>E-mail студента</td>
                    <td>Аватар студента</td>
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
                        /* Сделать удаление через жс */ 
                        echo "<td> <a href=\"delStudent".$student["student_id"]."\"><img class=\"deleteIcon\" src=\"templates/images/deleteIcon.jpg\" /></a></td>";
                    echo "</tr>";
                    }
                echo "</table> <br>";
            ?>
            <p><a href="addStudent"><img class="userPlusIcon" src="templates/images/topicPlusIcon.jpg" /></a> Добавить студента</p>
        </div>

        <div class="mentorsTableBlock">
        <?php
                echo "МЕНТОРЫ В СИСТЕМЕ:";
                echo "<table border=\"2\">";
                    echo "<tr>
                    <td>id ментора</td>
                    <td>Имя ментора</td>
                    <td>Фамилия ментора</td>
                    <td>Email ментора</td>
                    <td>Аватар ментора</td>
                    <td>Логин ментора</td>
                    <td>Основная специальность</td>
                    <td>Дополнительная специальность</td>
                    <td>Опыт</td>
                    <td>Учёная степень</td>
                    <td>Формат занятий</td>
                    <td>Дни занятий</td>
                    <td>Возраст</td>
                    <td>Сделать модератором</td>
                    <td>Удалить ментора</td>
                    </tr>";

                    foreach($users["mentors"] as $mentor){
                        echo "<tr>";
                            echo "<td>" . $mentor["mentor_id"] . "</td>";
                            echo "<td>" . $mentor["mentor_first_name"] . "</td>";
                            echo "<td>" . $mentor["mentor_surname"] . "</td>";
                            echo "<td>" . $mentor["mentor_email"] . "</td>";
                            echo "<td><img class=\"avatar\" src=".$mentor["mentor_avatar"]."</td>";
                            echo "<td>" . $mentor["mentor_login"] . "</td>";
                            echo "<td>" . $mentor["speciality"] . "</td>";
                            echo "<td>" . $mentor["add_speciality"] . "</td>";
                            echo "<td>" . $mentor["experience"] . "</td>";
                            echo "<td>" . $mentor["graduation"] . "</td>";
                            echo "<td>" . $mentor["format"] . "</td>";
                            echo "<td>" . $mentor["days"] . "</td>";
                            echo "<td>" . $mentor["age"] . "</td>";
                            echo "<td> <a href=\"moderateUser".$mentor["mentor_id"]."\"><img class=\"moderIcon\" src=\"templates/images/moderIcon.jpg\" /></a></td>";
                            echo "<td> <a href=\"delMentor".$mentor["mentor_id"]."\"><img class=\"deleteIcon\" src=\"templates/images/deleteIcon.jpg\" /></a></td>";
                        echo "</tr>";
                    }
                echo "</table>";
            ?>
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
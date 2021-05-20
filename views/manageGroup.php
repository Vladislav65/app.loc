<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление группой</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/css/style.css">
    <link rel="stylesheet" href="../templates/css/student.css">
    <link rel="stylesheet" href="../templates/css/users.css">
    <link rel="stylesheet" href="../templates/css/courseAdmin.css">
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
                            <?php 
                                        if($group['speciality'] == 'economics'){
                                    ?>
                                            <p>Дисциплина: Экономика</p>
                                    <?php
                                        }else{
                                    ?>
                                            <p>Дисциплина: Логистика</p>
                                    <?php
                                        }
                            ?>
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
                            <p><a href="inviteStudents<?php echo $group["id"] ?>"><img class="topicPlusIcon" src="templates/images/topicPlusIcon.jpg" /></a> Пригласить студентов</p>
                            <p><a href="mentorCourseAdd<?php echo $group["id"] ?>"><img class="topicPlusIcon" src="templates/images/redPlusIcon.jpg" /></a> Добавить курс</p> <br>
                            <h5>Список курсов: </h5>
                            <?php
                                echo "<table border=\"2\">";
                                    echo "<tr>
                                    <td>id курса</td>
                                    <td>Название курса</td>
                                    <td>Категория курса</td>
                                    <td>Описание</td>
                                    <td>Логотип курса</td>
                                    <td></td>
                                    <td></td>
                                    <td>Удалить курс</td>
                                    <tr>";

                                    foreach($group['coursesList'] as $item){
                                    echo "<tr>";
                                        echo "<td>" . $item["course_id"] . "</td>";
                                        echo "<td>" . $item["course_name"] . "</td>";
                                        echo "<td>" . $item["course_category"] . "</td>";
                                        echo "<td>" . $item["course_descr"] . "</td>";
                                        echo "<td><img class=\"avatar\" src=" . $item["course_img"]."></td>";
                                        echo "<td> <a href=\"updateCourse" . $item["course_id"] . ";" . $group['id'] . "\">Редактировать</a></td>";
                                        echo "<td> <a href=\"manageCourse" . $item["course_id"]."\">Содержимое курса</a></td>";
                                        echo "<td> <a href=\"deleteCourseFromGroup" . $item["course_id"] . ";" . $group["id"]."\"><img class=\"deleteIcon\" src=\"templates/images/deleteIcon.jpg\" /></a></td>";
                                    echo "</tr>";
                                    }
                                echo "</table> <br>";
                            ?>
                            <h5>Список студентов: </h5>
                            <?php
                                echo "<table border=\"2\">";
                                    echo "<tr>
                                    <td>id студента</td>
                                    <td>Имя студента</td>
                                    <td>Фамилия студента</td>
                                    <td>Email</td>
                                    <td>Логин</td>
                                    <td>Аватар</td>
                                    <tr>";

                                    foreach($group['studentsList'] as $item){
                                        echo "<tr>";
                                            echo "<td>" . $item["student_id"] . "</td>";
                                            echo "<td>" . $item["student_first_name"] . "</td>";
                                            echo "<td>" . $item["student_surname"] . "</td>";
                                            echo "<td>" . $item["student_email"] . "</td>";
                                            echo "<td>" . $item["student_login"] . "</td>";
                                            echo "<td><img class=\"avatar\" src=" . $item["student_avatar"]."></td>";
                                            echo "<td><a href=\"sendEmail" . $group['id'] . ';' . $item['student_id'] . "\">Отправить Email</a></td>";
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
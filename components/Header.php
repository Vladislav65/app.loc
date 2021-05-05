<?php
    include_once SITE_PATH . DS . "models" . DS . "User.php";
?>

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 logoTitleBlock">
            <?php
            if(User::isLogged() == false){

            ?>
                <h1><a href="/">Education Portal</a></h1>
            <?php
                }else{
            ?>
                <h1><a href="student">Education Portal</a></h1>
            <?php
                }
            ?>
            </div>
        </div>

        <div class="row downHeader">
            <div class="col-md-12 navigationBlock">
                <nav>
                    <ul type="none" class="navigation d-flex justify-content-center">
                        <li><a href="about">Руководство пользователя</a></li>
                        <li><a href="courses">Наши курсы</a></li>
                        <li><a href="mentors">Менторы</a></li>
                        <?php 
                        if(User::isLogged() == false){

                        ?>
                        <li><a href="userA">Авторизация</a></li>
                        <li><a href="userR">Регистрация</a></li>    
                        <?php 
                        }else{
                        ?>
                        <li><a href="mentorsT">Подобрать ментора</a></li>
                        <li><a href="userL">Выйти из аккаунта</a></li>
                        <?php 
                        } 
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
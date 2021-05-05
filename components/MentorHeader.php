<?php
    include_once SITE_PATH . DS . "models" . DS . "User.php";
?>

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 logoTitleBlock">
                <h1><a href="mentorM">Education Portal</a></h1>
            </div>
        </div>

        <div class="row downHeader">
            <div class="col-md-12 navigationBlock">
                <nav>
                    <ul type="none" class="navigation d-flex justify-content-center">
                        <li><a href="about">Руководство пользователя</a></li>
                        
                        <?php 
                        if(User::isLogged() == false){

                        ?>
                        <li><a href="userA">Авторизация</a></li>
                        <li><a href="userR">Регистрация</a></li>    
                        <?php 
                        }else{
                        ?>
                        <li><a href="mentorGr">Сформировать группу</a></li>
                        <li><a href="mentorMyGroups">Мои группы</a></li>
                        <!--<li><a href="mentorMyGroups">Сообщения</a></li>
                        <li><a href="mentorMyGroups">Студенты</a></li>-->
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
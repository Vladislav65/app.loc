<?php
    include_once SITE_PATH . DS . "models" . DS . "User.php";
?>

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 logoTitleBlock">
                <h1><a href="admin">Education Portal</a></h1>
            </div>
        </div>

        <div class="row downHeader">
            <div class="col-md-12 navigationBlock">
                <nav>
                    <ul type="none" class="navigation d-flex justify-content-center">
                        <li><a href="courseadd">Добавить курс </a></li>
                        <li><a href="coursecontrol">Управление курсами </a></li>
                        <li><a href="usercontrol">Управление пользователями </a></li>
                        <li><a href="graph">Графическая информация </a></li>
                        <li><a href="userLA">Выйти из аккаунта</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
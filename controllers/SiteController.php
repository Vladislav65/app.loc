<?php

/* Контроллер главной страницы */

class SiteController{

    public function actionIndex(){

        require_once SITE_PATH . DS . "views" . DS . "main.php";

        return true;
    }
}
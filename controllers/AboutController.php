<?php

/* Контроллер раздела "О нас" */

class AboutController{

    public function actionIndex(){
        
        require_once SITE_PATH . DS . "views" . DS . "about.php";

        return true;
    }

}
<?php

/* Класс-маршрутизатор приложения, обрабатывающий все запросы пользователя */

class Router{

    private $routes;

    // Присваиваем полю routes массив маршрутов, загруженный из файла Routes.php
    public function __construct()
    {
        $routesPath = SITE_PATH . DS . "configs" . DS . "Routes.php";
        $this->routes = include($routesPath); 
    }

    // Получение строки запроса
    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])){

            /* Исправляем баг в роутинге */
            /*$fixedUri = explode("/", $_SERVER['REQUEST_URI']);

            //var_dump($fixedUri); 

            if($fixedUri[1] == "user"){
                
                if($fixedUri[2] == "auth" || $fixedUri[2] == "register"){
                    return trim($_SERVER['REQUEST_URI'], "/");
                }else{
                    //var_dump($fixedUri);
                    $fixedUri[1] = end($fixedUri);
                    unset($fixedUri[2]);
                    $fixedUri = implode("/", $fixedUri);
                    $_SERVER['REQUEST_URI'] = trim($fixedUri, "/"); 
                    echo $_SERVER['REQUEST_URI'];
                    return $_SERVER['REQUEST_URI'];
                }
            }else{*/
                //return trim($_SERVER['REQUEST_URI'], "/");
            //}

            return trim($_SERVER['REQUEST_URI'], "/");
        }
    }

    public function run(){
        // Получение строки запроса
        $uri = $this->getURI();      
               
        foreach($this->routes as $uriPattern => $path){
            // strcasecmp($uriPattern, $uri) == 0 || 
            if(preg_match("~$uriPattern~", $uri)){
                // Определить, какой контроллер и экшн обрабатывают запрос

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //var_dump($internalRoute);
                
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments)."Controller";
                $controllerName = ucfirst($controllerName);
                
                $actionName = "action".ucfirst(array_shift($segments));
                $parameters = $segments;

                //Подключение файла класса контроллера
                $controllerFile = SITE_PATH . DS . "controllers" . DS .
                    $controllerName. ".php";

                if(file_exists($controllerFile)){
                    include_once $controllerFile;
                }

                //Создать объект нужного класса контроллера и вызвать метод
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject,
                                                     $actionName),
                                                     $parameters);

                if($result != null){
                    break;
                }
            }
        }
    }
}
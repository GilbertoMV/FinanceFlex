<?php
require_once 'controllers/errores.php';

class App{

    function __construct(){

        $url = isset($_GET['url']) ? $_GET['url']: null;
        $url = rtrim((string)$url, '/');
        //var_dump($url);
        /*
            controlador->[0]
            metodo->[1]
            parameter->[2]
        */
        $url = explode('/', $url);

        // cuando se ingresa sin definir controlador
        if(empty($url[0])){
            $archivoController = 'controllers/login.php';
            $archivoControllerAdmin = 'controllers/loginadmin.php';
            require_once $archivoController;
            require_once $archivoControllerAdmin;
            $controllerl = new Login();
            $controllera = new LoginAdmin();
            $controllerl->loadModel('login');
            $controllera->loadModel('loginadmin');
            $controllerl->render();
            $controllera->render();
            return false;
        }
        $archivoController = 'controllers/' . $url[0] . '.php';
        $archivoControllerAdmin = 'controllers/' . $url[0] . '.php';

        if(file_exists($archivoController) || file_exists($archivoControllerAdmin)){
            require_once $archivoController;
            require_once $archivoControllerAdmin;

            // inicializar controlador
            $controllera = new $url[0];
            $controllera->loadModel($url[0]);
            $controllerl = new $url[0];
            $controllerl->loadModel($url[0]);

            // si hay un método que se requiere cargar
            if(isset($url[1])){
                if(method_exists($controllera, $url[1]) || method_exists($controllerl, $url[1])){
                    if(isset($url[2])){
                        //el método tiene parámetros
                        //sacamos e # de parametros
                        $nparam = sizeof($url) - 2;
                        //crear un arreglo con los parametros
                        $params = [];
                        //iterar
                        for($i = 0; $i < $nparam; $i++){
                            array_push($params, $url[$i + 2]);
                        }
                        //pasarlos al metodo   
                        $controllera->{$url[1]}($params);
                        $controllerl->{$url[1]}($params);
                    }else{
                        $controllera->{$url[1]}();    
                        $controllerl->{$url[1]}();  
                    }
                }else{
                    $controllera = new Errores(); 
                    $controllerl = new Errores(); 
                }
            }else{
                $controllera->render();
                $controllerl->render();
            }
        }else{
            $controllera = new Errores();
            $controllerl = new Errores();
        }
    }
}

?>
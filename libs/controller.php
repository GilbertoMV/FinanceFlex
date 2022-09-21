<?php
class Controller{
    function __construct(){
        //todos los controladores estaran heredando dentro de este controller
        $this->view = new View(); //creando variable
    }
    //carga archivo del modelo de el controlador asociado
    function loadModel($model){
        $url = 'models/'.$model.'model.php';

        if(file_exists($url)){
            require_once $url;

            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }
    function existPOST($params){
        foreach($params as $param){
            if(!isset($_POST[$param])){
                error_log('CONTROLLER::existPOST=> No existe el parametro'. $param);
                return false;
                
            }
        }
        return true;
    }
    function existGET($params){
        foreach($params as $param){
            if(!isset($_GET[$param])){
                error_log('CONTROLLER::existGET=> No existe el parametro'. $param);
                return false;
                
            }
        }
        return true;
    }
    function getPost($name){
        return $_POST[$name];
    }
    function getGet($name){
        return $_GET[$name];
    }

    //posterior a un error o 
    //se complete la insercion de datos
    //redirigir al usuario a cierta pagina
    function redirect($route, $mensajes){
        $data = [];
        $params = '';
        foreach($mensajes as $key => $mensaje){
            array_push($data, $key . '=' . $mensaje);

        }
        /**delimitar parametros de data
        y unir como string */
        $params = join('&', $data);
        /**ejemplo 
         * ?nombre=Juan&apellido=Chipres
        */
        if($params != ''){
            $params = '?' . $params;
        }
        header('Location: ' . constant('URL') . '' . $route . $params);
    }

}
?>
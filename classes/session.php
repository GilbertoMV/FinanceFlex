<?php
class Session{

    private $sessionName = 'user';

    public function __construct(){
        //validar sesion existentes
        if(session_status()== PHP_SESSION_NONE){
            session_start();
        }//si ya existe la sesion entonces no iniciar
    }

    public function setCurrentUser($user){
        $_SESSION[$this->sessionName]= $user;
    }
    
    public function getCurrentUser(){
        return $_SESSION[$this->sessionName];
    }
    //Destruir la sesion
    public function closeSession(){
        session_unset();
        session_destroy();
    }
    //validar si la sesion sigue existiendo o no existe
    public function exists(){
        return isset($_SESSION[$this->sessionName]);
    }


}
?>
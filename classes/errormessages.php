<?php
class ErrorMessages{
    //ERROR_CONTROLLER_METHOD_ACTION
    const PRUEBA = "ERROR_1";
    const ERROR_SIGNUP_NEWUSER = "ERROR_2";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "ERROR_3";
    const ERROR_SIGNUP_NEWUSER_EXIST = "ERROR_4";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "ERROR_5";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "ERROR_6";
    const ERROR_LOGIN_AUTHENTICATE = "ERROR_7";


    private $errorList = [];

    public function __construct(){
        $this->errorList = [
            ErrorMessages::PRUEBA => 'El nombre de la categoria ya existe.',
            ErrorMessages::ERROR_SIGNUP_NEWUSER => 'Hubo un error al intentar procesar la solicitud.',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY => 'Llena los campos de email y password.',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EXIST => 'El email ya existe.',
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY => 'Llena los campos de email y password.',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => 'Inicia sesion.',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA => 'Email y/o password incorrecto.',
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE => 'No se puede procesar la solicitud. Ingresa email y password.'

        ];

    }

    public function get($cod){
        return $this->errorList[$cod];
    }

    public function existsKey($key){
        if(array_key_exists($key,$this->errorList)){
            return true;
        }
        else{
            return false;
        }
    }

}
?>
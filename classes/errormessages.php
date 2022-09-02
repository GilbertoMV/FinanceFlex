<?php
class ErrorMessages{
    //ERROR_CONTROLLER_METHOD_ACTION
    const PRUEBA = "ERROR_1";
    
    private $errorList = [];

    public function __construct(){
        $this->errorList = [
            ErrorMessages::PRUEBA => 'El nombre de la categoria ya existe.'
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
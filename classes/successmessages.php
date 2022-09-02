<?php

class SuccessMessages{
    //SUCCESS_CONTROLLER_METHOD_ACTION
    const PRUEBA = "OK_1";
    
    private $successList = [];
    public function __construct(){
        $this->successList = [
            SuccessMessages::PRUEBA => 'Este es un mensaje de exito.'
        ];
        
    }
    public function get($cod){
        return $this->successList[$cod];
    }

    public function existsKey($key){
        if(array_key_exists($key,$this->successList)){
            return true;
        }
        else{
            return false;
        }
    }
}

?>
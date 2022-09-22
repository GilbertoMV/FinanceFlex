<?php

class SuccessMessages{
    //SUCCESS_CONTROLLER_METHOD_ACTION
    const PRUEBA = "OK_1";
    const SUCCESS_REGISTER_OK = "OK_2";
    const SUCCESS_USER_UPDATEBUDGET = "OK_3";
    const SUCCESS_NEWEXPENSES = "OK_4";

    
    private $successList = [];
    public function __construct(){
        $this->successList = [
            SuccessMessages::PRUEBA => 'Este es un mensaje de exito.',
            SuccessMessages::SUCCESS_REGISTER_OK=> 'Se ha registrado correctamente.',
            SuccessMessages::SUCCESS_USER_UPDATEBUDGET=>'Se ha actualizado correctamente.',
            SuccessMessages::SUCCESS_NEWEXPENSES=>'Se ha agreagado un nuevo expense.'
        
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
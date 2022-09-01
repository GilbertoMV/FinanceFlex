<?php

class SuccessMessages{
    //SUCCESS_CONTROLLER_METHOD_ACTION
    const SUCCESS_ADMIN_NEWCATEGORY_EXISTS = "OK_1";
    
    private $successList = [];
    public function __construct(){
        $this->successList = [
            SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY_EXISTS => 'El nombre de la categoria ya existe.'
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
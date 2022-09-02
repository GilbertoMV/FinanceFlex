<?php
class View{

    function __construct(){
        
    }
    
    function render($nombre, $data = []){
        $this->d=$data;

        $this->handleMessage();


        require 'views/'.$nombre.'.php';
    }

    private function handleMessage(){
        //validar mensajes 
        if(isset($_GET['success']) && $_GET['error']){
            //error
        }else if(isset($_GET['success'])){
            $this->handleSuccess();
        }else if(isset($_GET['error'])){
            $this->handleError();
        }
    }
    private function handleError(){
        $cod = $_GET['error'];
        $error = new ErrorMessages();

        if($error->existsKey($cod)){
            $this->d['error'] = $error->get($cod);
    
        }
    }

    private function handleSuccess(){
        $cod = $_GET['success'];
        $success = new SuccessMessages();

        if($success->existsKey($cod)){
            $this->d['success'] = $success->get($cod);
    
        }
    }
    public function showMessages(){
        $this->showErrors();
        $this->showSuccess();
    }
    public function showErrors(){
        if(array_key_exists('error',$this->d)){
            echo '<div class="error">'.$this->d['error'].'</div>';
        }
    }
    public function showSuccess(){
        if(array_key_exists('success',$this->d)){
            echo '<div class="success">'.$this->d['success'].'</div>';
        }
    }
}
?>
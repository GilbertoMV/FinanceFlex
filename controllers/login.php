<?php
class Login extends sessionController{
    function __construct(){
        //llama al constructor padre
        parent::__construct();
        error_log('Login::construct->inicio de login');

    }
    function render(){
        error_log('Login::Render->Carga el index del login');
        $this->view->render('login/index');
    }
}
?>
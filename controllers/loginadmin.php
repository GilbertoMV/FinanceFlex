<?php

class LoginAdmin extends SessionAdmin{
    function __construct(){
        //llama al constructor padre
        parent::__construct();
        error_log('Login::construct->inicio de login');

    }
    function render(){
        error_log('Login::Render->Carga el index del login');
        $this->view->render('login/index');
    }

    function authenticate(){
        if($this->existPOST(['email', 'password'])){
            $email = $this->getPost('email');
            $password = $this->getPost('password');
            if($email == '' || empty($email) || $password == '' || empty($password)){
                $this->redirect('', ['error' =>ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
                error_log('Login::authenticate() empty');
            }
            $user = $this->model->loginadm($email, $password);
            if($user != NULL){
            //SI SE AUTENTICO EL USUARIO
            error_log('Login::authenticate() passed');    
                $this->initialize($user);
            }else{
                error_log('Login::authenticate() username and/or password wrong');
                $this->redirect('', ['error' =>ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA]);
            }
        }else{
            error_log('Login::authenticate() error with params');
            $this->redirect('', ['error' =>ErrorMessages::ERROR_LOGIN_AUTHENTICATE]);
        }
    }
}
?>
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

    function authenticate(){
        if($this->existPOST(['email', 'password'])){
            $email = $this->getPost('email');
            $password = $this->getPost('password');
            if($email == '' || empty($email) || $password == '' || empty($password)){
                $this->redirect('', ['error' =>ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
            }
            $user = $this->model->login($email, $password);

            if($user != NULL){
            //SI SE AUTENTICO EL USUARIO
                $this->initialize($user);
            }else{
                $this->redirect('', ['error' =>ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA]);
            }
        }else{
            $this->redirect('', ['error' =>ErrorMessages::ERROR_LOGIN_AUTHENTICATE]);
        }
    }
}
?>
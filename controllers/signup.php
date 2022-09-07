<?php
class Signup extends SessionController{

    function __construct()
    {
        parent::__construct();
    }

    function render(){
        $this->view->render('login/signup', []);

    }

    function newUser(){
        if($this->existPOST(['email', 'password'])){
            $email = $this->getPost('email');
            $password = $this->getPost('password');

            if($email == '' || empty($email) || $password == '' || empty($password)){
                $this->redirect('signup', ['error' =>ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
            }

            $user = new UserModel();
            $user ->setEmail($email);
            $user ->setPassword($password);
            $user->setRole('user');

            if($user->exists($email)){
                $this->redirect('sig', ['error' =>ErrorMessages::ERROR_SIGNUP_NEWUSER_EXIST]);
            }else if($user->save()){
                $this->redirect('sig', ['success' =>SuccessMessages::SUCCESS_REGISTER_OK]);
            }

        }else{
            $this->redirect('signup', ['error'=>ErrorMessages::ERROR_SIGNUP_NEWUSER]);
        }
    }
}
?>
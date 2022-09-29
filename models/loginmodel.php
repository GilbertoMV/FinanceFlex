<?php

require_once 'models/usermodel.php';

class LoginModel extends Model{
    function __constructor(){
        parent::__construct();
    }
    function login($email, $password) {
        try{
            $query = $this->prepare('SELECT * FROM usuarios WHERE email = :email');
            $query->execute(['email' => $email]);

            if($query->rowCount() == 1){
                $item = $query->fetch(PDO::FETCH_ASSOC);

                $user = new UserModel();
                $user->from($item);

                if(password_verify($password, $user->getPassword())){
                    error_log('LoginModel::login->success');
                    return $user;
                }else{
                    error_log('LoginModel::login->not success');
                    return NULL;
                }
            }
        }catch(PDOException $e){
            error_log('LoginModel::login->exception' . $e);
            return NULL;
        }
    }

}

?>
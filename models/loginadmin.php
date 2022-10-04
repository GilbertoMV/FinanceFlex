<?php

require_once 'models/adminmodel.php';

class LoginAdmin extends Model{
    function __constructor(){
        parent::__construct();
    }
    function loginadm($email, $password) {
        try{
            $query = $this->prepare('SELECT * FROM ejecutivos WHERE email = :email');
            $query->execute(['email' => $email]);

            if($query->rowCount() == 1){
                $item = $query->fetch(PDO::FETCH_ASSOC);
                $user = new AdminModel();
                $user->from($item);
                if(password_verify($password, $user->getPassword())){
                    error_log('LoginAdmin::login->success');
                    return $user;
                }else{
                    error_log('LoginAdmin::login->not success');
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
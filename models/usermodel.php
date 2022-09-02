<?php
class UserModel extends Model implements IModel{
    private $id;
    private $name;
    /* private $birth;
    private $photo;
    private $curp;
    private $phone; */
    private $email;
    private $password;
    public function __construct()
    {
        parent::__construct();
        $this->name='';
        $this->email='';
        $this->password='';
    
    }
        public function save(){
            try{
                $query=$this->prepare('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');
                $query->execute([
                    $this->name='',
                    $this->email='',
                    $this->password=''
                ]);
                return true;
            }catch(PDOException $e){
                error_log('USERMODEL::save->PDOException'. $e);
                return false;
            }
        }
        public function getAll(){
            $items = [];
            try{
                $query = $this->query('SELECT * FROM users');
                while($p = $query->fetch(\PDO::FETCH_ASSOC)){
                    $item = new UserModel();
                    $item->setId($p['id']);
                    $item->setName($p['name']);
                    $item->setEmail($p['email']);
                    $item->setPass($p['password']);

                    array_push($items, $item);
                }
                return $items;
            }catch(PDOException $e){
                error_log('USERMODEL::getAll->PDOException'. $e);


            }

        }
        //Existe email registrado
        public function exists($email){
            try{
                $query = $this->prepare('SELECT email FROM users WHERE email=:email');
                $query->execute(['email'=> $email]);
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                error_log('USERMODEL::exists->PDOException'. $e);
                return false;
            }

        }

        public function comparePasswords($password, $id){
            try{
                $user = $this->get($id);
                return password_verify($password, $user->getPass());
            }catch(PDOException $e){
                error_log('USERMODEL::exists->PDOException'. $e);
                return false;

            }
        }
        private function getHashedPassword($password){
            return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
        }

        public function get($id){
            try{
                $query = $this->prepare('SELECT * FROM users WHERE id=:id');
                $query->execute([
                    'id' => $id
                ]);
                $user = $query->fetch(\PDO::FETCH_ASSOC);
                
                $this->setId($user['id']);
                $this->setName($user['name']);
                $this->setEmail($user['email']);
                $this->setPass($user['password']);
                
                return $this;

            }catch(PDOException $e){
                error_log('USERMODEL::getId->PDOException'. $e);

            }     
        }
        public function delete($id){
            try{
                $query = $this->prepare('DELETE FROM users WHERE id=:id');
                $query->execute([
                    'id' => $id
                ]); 
                return true;
            }catch(PDOException $e){
                error_log('USERMODEL::deleteId->PDOException'. $e);
                return false;
            }

        }
        public function update($id){
            try{
                $query = $this->prepare('UPDATE users SET name=:name, email=:email, password=:password FROM users WHERE id=:id');
                $query->execute([
                    'id' =>         $this->id,
                    'name' =>       $this->name,
                    'email' =>      $this->email,
                    'password' =>   $this->password
                ]);
                return true;
            }catch(PDOException $e){
                error_log('USERMODEL::updateId->PDOException'. $e);
                return false;
            }     
        }
        //Pasar arreglo para asignar los campos existentes a los atributos de mi clase
        public function from($array){
            $this->id       = $array['id'];
            $this->name     = $array['name'];
            $this->email    = $array['email'];
            $this->password = $array['password'];
        }

        //ID
        public function setId($id){ 
            $this->id = $id;
        }       
        public function getId($id){
            return $this->id;
        }
        //NAME
        public function setName($name){ 
            $this->name = $name;
        }       
        public function getName($name){
            return $this->name;
        }
        //EMAIL
        public function setEmail($email){ 
            $this->password = $email;
        }       
        public function getEmail($email){
            return $this->email;
        }
        //PASSWORD
        public function setPass($password){ 
            $this->password = $this->getHashedPassword($password);
        }       
        public function getPass($password){
            return $this->password;
        }
    
}
?>
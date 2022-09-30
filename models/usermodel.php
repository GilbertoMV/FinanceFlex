<?php

class UserModel extends Model implements IModel{

    private $id;
    private $rfc;
    private $nombres;
    private $apellido_p;
    private $apellido_m;
    private $curp;
    private $telefono;
    private $password;
    private $email;
    private $fecha_naci;
    private $foto;
    private $role;
    private $saldo;
    private $id_genero;
    private $clave_eje;

    public function __construct(){
        parent::__construct();

        $this->rfc = '';
        $this->nombres = '';
        $this->apellido_p = '';
        $this->apellido_m = '';
        $this->curp = '';
        $this->telefono = '';
        $this->password = '';
        $this->email = '';
        $this->fecha_naci = '';
        $this->foto = '';
        $this->role = '';
        $this->saldo = 0.0;
        $this->id_genero = 0;
        $this->clave_eje = 0;
    }

    
    function updateBudget($budget, $iduser){
        try{
            $query = $this->db->connect()->prepare('UPDATE users SET budget = :val WHERE id = :id');
            $query->execute(['val' => $budget, 'id' => $iduser]);
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
        }catch(PDOException $e){
            error_log("Error-USERMODEL-updateBudget".$e);
            return NULL;
        }
    }

    function updateName($name, $iduser){
        try{
            $query = $this->db->connect()->prepare('UPDATE usuarios SET name = :val WHERE id = :id');
            $query->execute(['val' => $name, 'id' => $iduser]);

            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
        }catch(PDOException $e){
            return NULL;
        }
    }

    function updatePhoto($name, $iduser){
        try{
            $query = $this->db->connect()->prepare('UPDATE users SET photo = :val WHERE id = :id');
            $query->execute(['val' => $name, 'id' => $iduser]);

            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
        }catch(PDOException $e){
            return NULL;
        }
    }

    function updatePassword($new, $iduser){
        try{
            $hash = password_hash($new, PASSWORD_DEFAULT, ['cost' => 10]);
            $query = $this->db->connect()->prepare('UPDATE usuarios SET password = :val WHERE id = :id');
            $query->execute(['val' => $hash, 'id' => $iduser]);

            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        
        }catch(PDOException $e){
            return NULL;
        }
    }

    function comparePasswords($current, $userid){
        try{
            $query = $this->db->connect()->prepare('SELECT id, password FROM USERS WHERE id = :id');
            $query->execute(['id' => $userid]);
            
            if($row = $query->fetch(PDO::FETCH_ASSOC)) return password_verify($current, $row['password']);

            return NULL;
        }catch(PDOException $e){
            return NULL;
        }
    }



    public function save(){
        try{
            $query = $this->prepare('INSERT INTO usuarios (rfc, nombres, apellido_paterno, apellido_materno, curp, telefono, password, email, fecha_de_nacimiento, foto, role, saldo, id_genero, clave_ejecutivo	
            ) VALUES(:rfc, :nombres, :apellido_p, apellido_m, curp, telefono, password, email, fecha_naci, foto, role, saldo, id_genero, clave_eje)');
            $query->execute([
                'rfc' => $this->rfc,
                'nombres'  => $this->nombres, 
                'apellido_p' => $this->apellido_p,
                'apellido_m' => $this->apellido_m,
                'curp' => $this->curp,
                'telefono' => $this->telefono,
                'password' => $this->password,
                'fecha_naci'  => $this->fecha_naci,
                'foto' => $this->foto,
                'role' => $this->role,
                'saldo' => $this->saldo,
                'id_genero' => $this->id_genero,
                'clave_eje' => $this->clave_eje
                ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    } 

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM usuarios');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new UserModel();
                $item->setId($p['id']);
                $item->setNombres($p['nombres']);
                $item->setPassword($p['password'], false);
                $item->setRole($p['role']);
                $item->setBudget($p['budget']);
                $item->setPhoto($p['photo']);
                

                array_push($items, $item);
            }
            return $items;


        }catch(PDOException $e){
            echo $e;
        }
    }

    /**
     *  Gets an item
     */
    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM usuarios WHERE id = :id');
            $query->execute([ 'id' => $id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->id = $user['id'];
            $this->email = $user['email'];
            $this->password = $user['password'];
            $this->role = $user['role'];
            $this->budget = $user['budget']; 
            $this->photo = $user['photo'];
            $this->name = $user['name']; 
            return $this;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare('DELETE FROM users WHERE id = :id');
            $query->execute([ 'id' => $id]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('UPDATE usuarios SET email = :email, password = :password, budget = :budget, photo = :photo WHERE id = :id');
            $query->execute([
                'id'        => $this->id,
                'email'    => $this->email,
                'password' => $this->password,
                'budget' => $this->budget,
                'photo' => $this->photo
                ]);
            return true;
        }catch(PDOException $e){
            //echo $e;
            return false;
        }
    }

    public function exists($email){
        try{
            $query = $this->prepare('SELECT email FROM usuarios WHERE email = :email');
            $query->execute( ['email' => $email]);
            
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function from($array){
        $this->id = $array['id'];
        $this->rfc = $array['rfc'];
        $this->nombres = $array['nombres'];
        $this->apellido_p = $array['apellido_paterno'];
        $this->apellido_m = $array['apellido_materno'];
        $this->curp = $array['curp'];
        $this->telefono = $array['telefono'];
        $this->password = $array['password'];
        $this->email = $array['email'];
        $this->fecha_naci = $array['fecha_nacimiento'];
        $this->foto = $array['foto'];
        $this->role = $array['role'];
        $this->saldo = $array['saldo'];
        $this->id_genero = $array['id_genero'];
        $this->clave_eje = $array['clave_ejecutivo'];
    }

    private function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    //SETTERS
    public function setId($id){                    $this->id = $id;}
    public function setRfc($rfc){                  $this->rfc = $rfc;}
    public function setNombres($nombres){          $this->nombres = $nombres;}
    public function setApellidoP($apellido_p){     $this->apellido_p = $apellido_p;}
    public function setApellidoM($apellido_m){     $this->apellido_m = $apellido_m;}
    public function setCurp($curp){                $this->curp = $curp;}
    public function setTelefono($telefono){        $this->telefono = $telefono;}
    public function setPassword($password, $hash = true){ 
        if($hash){
            $this->password = $this->getHashedPassword($password);
        }else{
            $this->password = $password;
        }
    }
    public function setEmail($email){             $this->email = $email;}
    public function setFechaN($fecha_naci){       $this->fecha_naci = $fecha_naci;}
    public function setFoto($foto){               $this->foto = $foto;}
    public function setRole($role){               $this->role = $role;}
    public function setSaldo($saldo){             $this->saldo = $saldo;}
    public function setGenero($id_genero){        $this->id_genero = $id_genero;}
    public function setEjecutivo($clave_eje){     $this->clave_eje = $clave_eje;}


    //GETTERS
    public function getId(){                return    $this->id;}
    public function getRfc(){               return    $this->rfc;}
    public function getNombres(){           return    $this->nombres;}
    public function getApellidoP(){         return    $this->apellido_p;}
    public function getApellidoM(){         return    $this->apellido_m;}
    public function getCurp(){              return    $this->curp;}
    public function getTelefono(){          return    $this->telefono;}
    public function getPassword(){          return    $this->password;}
    public function getEmail(){             return    $this->email;}
    public function getFechaN(){            return    $this->fecha_naci;}
    public function getFoto(){              return    $this->foto;}
    public function getRole(){              return    $this->role;}
    public function getSaldo(){             return    $this->saldo;}
    public function getGenero(){            return    $this->id_genero;}
    public function getEjecutivo(){         return    $this->clave_eje;}
    
}

?>
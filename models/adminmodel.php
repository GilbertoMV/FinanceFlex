<?php

class AdminModel extends Model implements IModel{

    private $id; //clave_ejecutivo
    private $nombre;
    private $password;
    private $email;
    private $role;
    private $id_ejecutivo;


    public function __construct(){
        parent::__construct();

        $this->nombre = '';
        $this->password = '';
        $this->email = '';
        $this->role = '';
        $this->id_ejecutivo = 0;
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
            $query = $this->db->connect()->prepare('UPDATE usuarios SET foto = :val WHERE id = :id');
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
//UTILIZANDOSE
    function comparePasswords($current, $id){
        try{
            $query = $this->db->connect()->prepare('SELECT clave_ejecutivo, password FROM ejecutivos WHERE id = :id');
            $query->execute(['id' => $id]);
            
            if($row = $query->fetch(PDO::FETCH_ASSOC)) return password_verify($current, $row['password']);

            return NULL;
        }catch(PDOException $e){
            error_log($e);
            return NULL;
        }
    }

//USAR PARA REGISTRO DE EJECUTIVOS
    public function save(){
        try{
            $query = $this->prepare('INSERT INTO ejecutivos (rfc, nombres, apellido_paterno, apellido_materno, curp, telefono, password, email, fecha_de_nacimiento, foto, role, saldo, id_genero, clave_ejecutivo	
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

    //USANDOSE PARA OBTENER UN INFORMACION DE LA TABLA EJECUTIVOS

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM ejecutivos');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new AdminModel();
                $item->setId($p['clave_ejecutivo']);
                $item->setNombre($p['nombre']);
                $item->setIdEjecutivo($p['id_ejecutivo']);
                $item->setEmail($p['email']);
                $item->setPassword($p['password'], false);
                $item->setRole($p['role']);

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
            $query = $this->prepare('SELECT * FROM ejecutivos WHERE id = :id');
            $query->execute([ 'id' => $id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            $this->id           = $user['clave_ejecutivo'];
            $this->nombre       = $user['nombre'];
            $this->id_ejecutivo = $user['id_ejecutivo'];
            $this->email        = $user['email'];
            $this->password     = $user['password'];
            $this->role         = $user['role'];
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
            $query = $this->prepare('SELECT email FROM ejecutivos WHERE email = :email');
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
        $this->id           = $array['clave_ejecutivo'];
        $this->nombre       = $array['nombre'];
        $this->id_ejecutivo = $array['id_ejecutivo'];
        $this->email        = $array['email'];
        $this->password     = $array['password'];
        $this->role         = $array['role'];
    }

    private function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }


    
    //SETTERS
    public function setId($id){                           $this->id = $id;}
    public function setNombre($nombre){                   $this->nombre = $nombre;}
    public function setEmail($email){                     $this->email = $email;}
    public function setRole($role){                       $this->role = $role;}
    public function setIdEjecutivo($id_ejecutivo){        $this->id_ejecutivo = $id_ejecutivo;}
    public function setPassword($password, $hash = true){ 
        if($hash){
            $this->password = $this->getHashedPassword($password);
        }else{
            $this->password = $password;
        }
    }

    //GETTERS
    public function getId(){                return    $this->id;}
    public function getNombre(){            return     $this->nombre;}
    public function getPassword(){          return    $this->password;}
    public function getEmail(){             return    $this->email;}
    public function getRole(){              return    $this->role;}
    public function getIdEjecutivo(){       return  $this->id_ejecutivo;}
    
}

?>
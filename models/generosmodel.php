<?php

class GenerosModel extends Model implements IModel{

    private $id;
    private $nombre;

    public function __construct(){
        parent::__construct();
    }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO genero (name, color) VALUES(:name, :color)');
            $query->execute([
                'name' => $this->name, 
                'color' => $this->color
            ]);
            if($query->rowCount()) return true;

            return false;
        }catch(PDOException $e){
            return false;
        }
    }
    public function getAll(){
        error_log("Models::GenerosModel-getAll");
        $items = [];

        try{
            $query = $this->query('SELECT * FROM genero');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new GenerosModel();
                $item->from($p); 
                
                array_push($items, $item);
            }

            return $items;

        }catch(PDOException $e){
            echo $e;
        }
    }
    
    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM genero WHERE id = :id');
            $query->execute([ 'id' => $id]);
            $category = $query->fetch(PDO::FETCH_ASSOC);

            $this->from($category);

            return $this;
        }catch(PDOException $e){
            return false;
        }
    }
    public function delete($id){
        try{
            $query = $this->db->connect()->prepare('DELETE FROM categories WHERE id = :id');
            $query->execute([ 'id' => $id]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
    public function update(){
        try{
            $query = $this->db->connect()->prepare('UPDATE categories SET name = :name, color = :color WHERE id = :id');
            $query->execute([
                'name' => $this->name, 
                'color' => $this->color
            ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function exists($name){
        try{
            $query = $this->prepare('SELECT name FROM categories WHERE name = :name');
            $query->execute( ['name' => $name]);
            
            if($query->rowCount() > 0){
                error_log('CategoriesModel::exists() => true');
                return true;
            }else{
                error_log('CategoriesModel::exists() => false');
                return false;
            }
        }catch(PDOException $e){
            error_log($e);
            return false;
        }
    }

    public function from($array){
        $this->id = $array['id_genero'];
        $this->nombre = $array['nombre'];
    }

    

    public function setId($id){$this->id = $id;}
    public function setNombre($nombre){$this->nombre = $nombre;}


    public function getId(){return $this->id;}
    public function getNombre(){ return $this->nombre;}
}

?>
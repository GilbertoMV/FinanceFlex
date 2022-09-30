<?php
class CategoriesModel extends Model implements IModel{
    private $id;
    private $name;
    private $color;

    public function __construct(){
        parent::__construct();
    }
    public function save(){
        try {
            $query=$this->prepare('INSERT INTO categorias (nombre,color) VALUES (:name, :color)');
            $query->execute(['name' => $this->name, 'color' => $this->color]);
            if($query->rowCount()) return true;

            return false;
        } catch (PDOException $e) {
            return false;
        }

    }
    public function getAll(){
        $items = [];
        try {
            $query=$this->query('SELECT * FROM categorias');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new CategoriesModel();
                $item->from($p);

                array_push($items,$item);
            }
            return $items;

        } catch (PDOException $e) {
            echo $e;
        }

    }
    public function get($id){
        try {
            $query=$this->prepare('SELECT * FROM categorias WHERE id = :id');
            $query -> execute(['id' => $id]);
            $category = $query->fetch(PDO::FETCH_ASSOC);

            $this->from($category);
            return $this;
        } catch (PDOException $e) {
            return NULL;
        }

    }
    public function delete($id){
        try {
            $query=$this->prepare('DELETE FROM categorias WHERE id = :id');
            $query -> execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    /*MODIFICAR ALGUNA CATEGORIA POR AHORA NO EN USO */
    public function update(){
        try {
            $query=$this->prepare('UPDATE categorias SET name = :name, color = :color FROM categories WHERE id = :id');
            $query -> execute(['name' => $this->name, 'color' => $this->color]);
            $category = $query->fetch(PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    } 
    public function from($array){
        $this->id = $array['id'];
        $this->name = $array['nombre'];
        $this->color = $array['color'];
    }

    public function exists($name){
        try {
            $query=$this->prepare('SELECT nombre FROM categorias WHERE nombre = :name');
            $query->execute(['name' => $this->$name]);
            if($query->rowCount() > 0){
                error_log('CategoriesModel::exists() => true');
                return true;
            }else{
                error_log('CategoriesModel::exists() => false');
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
 
    public function getId(){ return $this->id;}
    public function getName(){ return $this->name;} 
    public function getColor(){ return $this->color;}

    public function setId($id){ $this->id = $id;}
    public function setName($name){ $this->name = $name;}
    public function setColor($color){ $this->color = $color;}

}
?>
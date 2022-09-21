<?php

class JoinExpensesCategoriesModel extends Model{
    private $expenseId;
    private $title;
    private $amount;
    private $categoryId;
    private $date;
    private $userId; 
    private $nameCategory;
    private $color;

    public function __construct(){
        parent::__construct();
    }
    public function getAll($userId){
        $items=[];
        try {
            $query = $this->prepare('SELECT expenses.id as expense_id, title, category_id, amount, date, id_user, categories.id, name, color FROM expenses INNER JOIN categories WHERE expenses.category_id = categories.id AND expenses.id_user = :userid ORDER BY date;');
            $query ->execute(['userid'=> $userId]);
            
            while ($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new JoinExpensesCategoriesModel();
                $item->from($p);
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            error_log("**ERROR: JoinExpensesCategoriesModel::getAll: error: " . $e);
        }
    }
    public function from($array){
        $this->expenseId = $array['expense_id'];
        $this->title = $array['title'];
        $this->categoryId = $array['category_id'];
        $this->amount = $array['amount'];
        $this->date=$array['date'];
        $this->userId = $array['id_user'];
        $this->nameCategory = $array['name'];
        $this->color = $array['color'];
    }
    public function toArray(){
        $array = [];
        $array['id'] = $this->expenseId;
        $array['title'] = $this->title;
        $array['categoryId'] = $this->categoryId;
        $array['amount'] = $this->amount;
        $array['date'] = $this->date;
        $array['id_user'] = $this->userId;
        $array['name'] = $this->nameCategory;
        $array['color'] = $this->color;

        return $array;
    }

    public function getExpenseId(){return $this->expenseId;}
    public function getTitle(){return $this->title;}
    public function getCategoryId(){return $this->categoryId;}
    public function getAmount(){return $this->amount;}
    public function getDate(){return $this->date;}
    public function getUserid(){ return $this->userid;}
    public function getNameCategory(){return $this->nameCategory;}
    public function getColor(){ return $this->color;}

    public function setExpenseId($value){$this->expenseId = $value;}
    public function setTitle($value){$this->title = $value;}
    public function setCategoryId($value){$this->categoryId = $value;}
    public function setAmount($value){$this->amount = $value;}
    public function setDate($value){$this->date = $value;}
    public function setUserid($value){$this->userid = $value;}
    public function setNameCategory($value){$this->nameCategory = $value;}
    public function setColor($value){$this->color = $value;}
}

?>
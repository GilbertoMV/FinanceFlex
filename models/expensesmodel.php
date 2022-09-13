<?php

class ExpensesModel extends Model implements IModel{
    private $id;
    private $title;
    private $amount;
    private $categoryid;
    private $date;
    private $userid;

    public function setId($id){         $this->id = $id;}
    public function setTitle($title){ $this->title = $title;}
    public function setAmount($amount){ $this->amount = $amount;}
    public function setCategoryid($categoryid){ $this->categoryid = $categoryid;}
    public function setDate($date){ $this->date = $date;}
    public function setUserid($userid){ $this->userid = $userid;}

    public function getId(){ return $this->id; }
    public function getTitle(){  return $this->title; }
    public function getAmount(){ return $this->amount; }
    public function getCategoryid(){ return $this->categoryid; }
    public function getDate(){ return $this->date; }
    public function getUserid(){ return $this->userid; }

    public function __construct(){
        parent::__construct();
        
    }
    public function save(){
        try {
            $query = $this->prepare('INSERT INTO expenses (title, amount, category_id, date, id_user) VALUES (:title, :amount, :category, :d, :user');
            $query->execute(['title' => $this->title, 'amount' => $this->amount, 'category' => $this->categoryid, 'user' => $this->userid, 'd'=>$this->date]);
            if($query->rowCount())return true;
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getAll(){
        $items=[];
        try {
            $query = $this->query('SELECT * FROM expenses');
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ExpensesModel();
                $item->from($p);

                array_push($items, $item);
            }

            return $items;

        } catch (PDOException $e) {
            return false;
        }
    }
    public function get($id){
        try {
            $query = $this->prepare('SELECT * FROM expenses WHERE id = :id');
            $query->execute(['id' => $id]);
            $expense = $query->fetch(PDO::FETCH_ASSOC);
            $this->from($expense);

            return $this;

        } catch (PDOException $e) {
            return false;
        }
    }
    public function delete($id){
        try {
            $query = $this->prepare('DELETE FROM expenses WHERE id = :id');
            $query->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function update(){
        try {
            $query = $this->prepare('UPDATE INTO expenses SET title=:title, amount=:amount, category_id = :category, date = :d, id_user = :user WHERE id= :id');
            $query->execute(['title' => $this->title, 'amount' => $this->amount, 'category' => $this->categoryid, 'user' => $this->userid, 'd'=>$this->date, 'id' => $this->id]);
            if($query->rowCount())return true;
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
    //
    public function from($array){
        $this->id = $array['id'];
        $this->title = $array['title'];
        $this->amount = $array['amount'];
        $this->categoryid = $array['category_id'];
        $this->date = $array['date'];
        $this->userid = $array['user_id'];
    }
    public function getAllByUserId($user_id){
        $items = [];
        try {
            $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :userid');
            $query->execute(['userid' => $user_id]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ExpensesModel();
                $item->from($p);

                array_push($items, $item);

            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    public function getByUserIdAndLimit($user_id, $n){
        $items = [];
        try {
            $query = $this->prepare('SELECT * FROM expenses WHERE id_user = :userid ORDER BY expenses.date DESC LIMIT 0, :n');
            $query->execute(['userid' => $user_id, 
            'n' => $n]);
            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new ExpensesModel();
                $item->from($p);

                array_push($items, $item);

            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    public function getTotalAmountThisMonth($user_id){
        try {
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT SUM(amount) AS total FROM expenses WHERE YEAR(date) = :year AND MONTH(date) = :month AND id_user = :userid');
            $query->execute(['userid' => $user_id, 
            'year' => $year, 'month' => $month]);
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total = NULL) $total =0;
            return $total;

        } catch (PDOException $e) {
            return NULL;
        }
    }
    public function getMaxAmountThisMonth($user_id){
        try {
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT MAX(amount) AS total FROM expenses WHERE YEAR(date) = :year AND MONTH(date) = :month id_user = :userid');
            $query->execute(['userid' => $user_id, 
            'year' => $year, 'month' => $month]);
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total = NULL) $total =0;
            return $total;

        } catch (PDOException $e) {
            return NULL;
        }
    }
    function getTotalByMonthAndCategory($date, $categoryid, $userid){
        try {
            $total = 0;
            $year = substr($date, 0, 4);
            $month = substr($date, 5,7);
            $query = $this->prepare('SELECT SUM(amount) ad total FROM expenses WHERE category_id = :categoryid AND id_user = :user AND YEAR(date) = :year AND MONTH(date) = :month');
            $query ->execute(['categoryid'=>$categoryid,'userid'=>$userid, 'year'=>$year, 'month'=>$month]);
            if($query ->rowCount() > 0){
                $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            }else{
                return 0;
            }
            return $total;
        } catch (PDOException $e) {
            return NULL;
        }
    }
    public function getTotalByCategoryThisMonth($categoryid, $user_id){
        try {
            $total =0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT SUM(amount) AS total FROM expenses WHERE categoryid = :categoryid and YEAR(date) = :year AND MONTH(date) = :month AND id_user = :userid ');
            $query->execute(['userid' => $user_id, 
            'year' => $year, 'month' => $month, 'categoryid' => $categoryid]);
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total = NULL) $total =0;
            return $total;

        } catch (PDOException $e) {
            return NULL;
        }
    }
    public function getNumberOfExpensesByCategoryThisMonth($categoryid, $user_id){
        try {
            $total =0;
            $year = date('Y');
            $month = date('m');
            $query = $this->prepare('SELECT COUNT(amount) AS total FROM expenses WHERE categoryid = :categoryid and YEAR(date) = :year AND MONTH(date) = :month AND id_user = :userid ');
            $query->execute(['userid' => $user_id, 
            'year' => $year, 'month' => $month, 'categoryid' => $categoryid]);
            $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
            if($total = NULL) $total =0;
            return $total;

        } catch (PDOException $e) {
            return NULL;
        }
    }
    

}

?>
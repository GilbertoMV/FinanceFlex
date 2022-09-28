<?php
require_once 'models/expensesmodel.php';
require_once 'models/categoriesmodel.php';
class Admin extends SessionController{
    function __construct()
    {
        parent::__construct(); 
        
    }

    function render(){
        $stats = $this->getStatistics();
        $this->view->render('admin/index', [
            'stats' => $stats
        ]);
    }
    function getStatistics(){
        $res = [];

        $userModel = new UserModel();
        $users = $userModel->getAll();

        $expenseModel = new ExpensesModel();
        $expenses = $expenseModel->getAll();

        $categoriesModel = new CategoriesModel();
        $categories = $categoriesModel->getAll();

        $res['count-users'] = count($users);
        $res['count-expenses'] = count($expenses);
        $res['max-expenses'] = $this->getMaxAmount($expenses);
        $res['min-expenses'] = $this->getMinAmount($expenses);
        $res['avg-expenses'] = $this->getAverageAmount($expenses);
        
        $res['count-categories'] = count($categories);
        $res['mostused-categories'] = $this->getCategoryMostUsed($expenses);
        $res['lessused-categories'] = $this->getCategoryLessUsed($expenses);

        return $res;

    }
    private function getMaxAmount($expenses){
        $max = 0;
        foreach ($expenses as $expense) {
            $max = max($max, $expense->getAmount());
        }

        return $max;
    }
    private function getMinAmount($expenses){
        $min = $this->getMaxAmount($expenses);
        foreach ($expenses as $expense) {
            $min = min($min, $expense->getAmount());
        }

        return $min;
    }

    private function getAverageAmount($expenses){
        $sum = 0;
        foreach ($expenses as $expense) {
            $sum += $expense->getAmount();
        }

        return ($sum / count($expenses));
    }

    private function getCategoryMostUsed($expenses){
        $repeat = [];

        foreach ($expenses as $expense) {
            if(!array_key_exists($expense->getCategoryId(), $repeat)){
                $repeat[$expense->getCategoryId()] = 0;    
            }
            $repeat[$expense->getCategoryId()]++;
        }
        $categoryMostUsed = 0;
        $maxCategory = max($repeat);
        foreach($repeat as $index => $category){
            if($category == $maxCategory){
                $categoryMostUsed = $index;
            }
        }
 
        $categoryModel = new CategoriesModel();
        $categoryModel->get($categoryMostUsed);
        $category = $categoryModel->getName();
        error_log('Admin::getCategoryMostUse() ->' . $categoryMostUsed); 

        return $category;
    }

    private function getCategoryLessUsed($expenses){
        $repeat = [];

        foreach ($expenses as $expense) {
            if(!array_key_exists($expense->getCategoryId(), $repeat)){
                $repeat[$expense->getCategoryId()] = 0;    
            }
            $repeat[$expense->getCategoryId()]++;
        }

        //$categoryMostUsed = min($repeat);
        $categoryMostUsed = 0;
        $maxCategory = min($repeat);
        foreach($repeat as $index => $category){
            if($category == $maxCategory){
                $categoryMostUsed = $index;
            }
        }
        $categoryModel = new CategoriesModel();
        $categoryModel->get($categoryMostUsed);

        $category = $categoryModel->getName();

        return $category;
    }
}
?>
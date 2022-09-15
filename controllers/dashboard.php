<?php
require_once 'models/expensesmodel.php';
require_once 'models/categoriesmodel.php';
class Dashboard extends sessionController{
    private $user;
    
    function __construct(){
        //llama al constructor padre
        parent::__construct();
        //obtener info del usuario actual
        $this->user = $this->getUserSessionData();
        error_log('Dashboard::construct->inicio de Dashboard');

    }
    function render(){
        error_log('Dashboard::Render->Carga el index del Dashboard');
        
        $expensesModel = new ExpensesModel();
        $expense = $this->getExpense(5);
        $totalThisMonth = $expensesModel->getTotalAmountThisMonth($this->user->getId());
        $maxExpensesThisMonth = $expensesModel->getMaxAmountThisMonth($this->user->getId());
        $categories = $this->getCategories();



        $this->view->render('dashboard/index', [
            'user' => $this->user,
            'expense' => $expense,
            'totalAmmountThisMonth' => $totalThisMonth,
            'maxExpensesThisMonth' => $maxExpensesThisMonth,
            'categories' => $categories
        ]);
    }

    private function getExpense($n = 0){
        if($n < 0){
            return NULL;
        }else{
            $expenses = new ExpensesModel();
            return $expenses -> getByUserIdAndLimit($this->user->getId(),$n);
        }
    }
    private function getCategories(){
        $res = [];
        $categoriesModel = new CategoriesModel();
        $expensesModel = new ExpensesModel();

        $categories = $categoriesModel->getAll();

        foreach($categories as $category){
            $categoryArray = [];

            $total = $expensesModel ->getTotalByCategoryThisMonth($category->getId(), $this->user->getId());
            $numberOfExpenses = $expensesModel ->getNumberOfExpensesByCategoryThisMonth($category->getId(), $this->user->getId());

            if($numberOfExpenses > 0){
                $categoryArray['total'] = $total;
                $categoryArray['count'] = $numberOfExpenses;
                $categoryArray['category'] = $category;
                array_push($res, $categoryArray);


            }
        }
    }
}
?>
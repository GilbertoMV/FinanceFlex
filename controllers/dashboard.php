<?php
class Dashboard extends sessionController{
    function __construct(){
        //llama al constructor padre
        parent::__construct();
        error_log('Dashboard::construct->inicio de Dashboard');

    }
    function render(){
        error_log('Dashboard::Render->Carga el index del Dashboard');
        $this->view->render('dashboard/index');
    }
}
?>
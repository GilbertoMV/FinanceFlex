<?php
session_start();
//include __DIR__ .'\..\error-log.php';
//error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION["id_ejecutivo"])){
    require_once __DIR__ .'\..\includes\db.php';
    $records = $conn->prepare('SELECT id_cliente, nom, apellidoP, apellidoM FROM clientes WHERE id_ejecutivo = :id_ejecutivo');
    $records->bindParam(':id_ejecutivo', $_SESSION['id_ejecutivo']);
    $records->execute();    
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
?>
    <nav>
        <div class="nav__container">
            <a href="index.php"><img class="logo" src="../public/img/logoEjecutivo.png" alt="home"></a>
            
            <div class="nav__menu">
                <a href="index.php" class="a">Lista de Clientes</a>
                <a href="darAlta.php" class="a">Dar de alta</a>
                <a href="../controllers/logoutcontroller.php" class="logout">Cerrar Sesion <i class="bi bi-door-closed"></i></a>
            </div>
        </div>   
    </nav>
<?php
}else{
    header('Location:../login.php');
}
?>
<?php
session_start();
include __DIR__ .'\..\error-log.php';
error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION["id_ejecutivo"])){
    require_once __DIR__ .'\..\includes\db.php';
    $records = $conn->prepare('SELECT id_cliente, nom, apellidoP, apellidoM FROM clientes WHERE id_ejecutivo = :id_ejecutivo');
    $records->bindParam(':id_ejecutivo', $_SESSION['id_ejecutivo']);
    $records->execute();    
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
?>
    <a href="index.php"><img class="logo" src="../public/img/logito.png" alt=""></a>
    <a href="index.php" class="red a">EJECUTIVOS<br><span>FinanceFlex</span></a>
    <nav>
        <div class="container">
            <ul>
                <li><a href="darAlta.php" class="a">Dar de alta</a></li>
                <li><a href="modificaciones.php" class="a">Modificaciones</a></li>
                <li><a href="darBaja.php" class="a">Dar de Baja</a></li>
                <li><a href="pagos.php" class="a">Pagos</a></li>
                <li><a href="depositosRetiros.php" class="a">Depositos y Retiros</a></li>
            </ul>
        </div>
    </nav>
    <a href="../controllers/logoutcontroller.php"><img class="logout" src="../public/img/switch.png" alt="cerrar"></a>
    <div class="linea"></div>
<?php
}else{
    header('Location:../login.php');
}
?>
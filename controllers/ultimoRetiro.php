<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$sql = $conn->prepare('SELECT cuenta.numCta FROM clientes INNER JOIN cuenta ON clientes.id_cliente = cuenta.id_cliente WHERE cuenta.id_cliente = :id_cliente');
$sql->bindParam(':id_cliente', $_SESSION['id_cliente']);
$sql->execute();
$infocl = $sql->fetch(PDO::FETCH_ASSOC);

$records = $conn->prepare('SELECT monto FROM movimientos WHERE numCta = :numCta AND tipo = "Retiro" ORDER BY fecha_hora ASC LIMIT 0,1');
$records->bindParam(':numCta', $infocl['numCta']);
$records->execute();
$saldo = $records->fetchAll(PDO::FETCH_ASSOC);
if($records->rowCount() > 0){
    echo json_encode($saldo);
}
else{
    echo json_encode('null');
}

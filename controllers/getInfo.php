<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$sql = $conn->prepare('SELECT cuenta.numCta, cuenta.saldo, clientes.rfc, clientes.id_ejecutivo, clientes.foto FROM clientes INNER JOIN cuenta ON clientes.id_cliente = cuenta.id_cliente WHERE cuenta.id_cliente = :id_cliente');
$sql->bindParam(':id_cliente', $_SESSION['id_cliente']);
$sql->execute();
$infocl = $sql->fetch(PDO::FETCH_ASSOC);
if($sql->rowCount() > 0){
    echo json_encode($infocl);
}else{
    echo json_encode('null');
}
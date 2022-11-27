<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$sql = $conn->prepare('SELECT curp,nom, apellidoP, apellidoM, curp, telefono, fechaNac, genero FROM clientes WHERE id_cliente = :id_cliente');
$sql->bindParam(':id_cliente', $_SESSION['id_cliente']);
$sql->execute();
$infocl = $sql->fetch(PDO::FETCH_ASSOC);
if($sql->rowCount() > 0){
    echo json_encode($infocl);
}else{
    echo json_encode('null');
}
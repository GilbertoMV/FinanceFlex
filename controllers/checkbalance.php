<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$id_cliente=$_SESSION['id_cliente'];
$records = $conn->prepare('SELECT saldo FROM cuenta WHERE id_cliente = :id_cliente');
$records->bindParam(':id_cliente', $id_cliente);
$records->execute();
$saldo = $records->fetchAll(PDO::FETCH_ASSOC);
exit(json_encode($saldo));
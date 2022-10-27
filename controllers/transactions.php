<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$id_cliente=$_SESSION['id_cliente'];
$records = $conn->prepare('SELECT movimientos.tipo, movimientos.monto, movimientos.fecha_hora FROM cuenta INNER JOIN movimientos ON cuenta.id_cliente = '.$id_cliente.'');
$records->execute();
$transaccion = $records->fetchAll(PDO::FETCH_ASSOC);
if($records->rowCount() > 0){
    echo json_encode($transaccion);
}
else{
    echo json_encode('null');
}
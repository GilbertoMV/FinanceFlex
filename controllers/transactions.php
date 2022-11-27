<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$id_cliente=$_SESSION['id_cliente'];
$records = $conn->prepare('SELECT movimientos.tipo, movimientos.monto, DATE(movimientos.fecha_hora) as fecha, TIME(movimientos.fecha_hora) as hora FROM cuenta INNER JOIN movimientos on movimientos.numCta = cuenta.numCta where cuenta.id_cliente = '.$id_cliente.' ORDER BY fecha_hora LIMIT 0,5');
$records->execute();
$transaccion = $records->fetchAll(PDO::FETCH_ASSOC);
if($records->rowCount() > 0){
    echo json_encode($transaccion);
}
else{
    echo json_encode('null');
}
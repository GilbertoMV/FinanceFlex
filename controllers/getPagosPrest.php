<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$id_cliente=$_POST['id_cliente'];
$records = $conn->prepare('SELECT DATE(pagos.fecha_hora) as fecha, TIME(pagos.fecha_hora) as hora, pagos.monto, pagos.id_prestamo, pagos.id_pago FROM cuenta INNER JOIN pagos where cuenta.id_cliente= '.$id_cliente.' ORDER BY fecha_hora');
$records->execute();
$transaccion = $records->fetchAll(PDO::FETCH_ASSOC);
if($records->rowCount() > 0){
    echo json_encode($transaccion);
}
else{
    echo json_encode('null');
}
<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$cta=$_POST['numcta'];
$monto=$_POST['monto'];
try{
    $records = $conn->prepare('SELECT saldo FROM cuenta WHERE numCta = :numCta');
    $records->bindParam(':numCta', $cta);
    $records->execute();
    if($records->rowCount() > 0){
        $tipo = "Deposito";
        $update = $conn->prepare('INSERT INTO movimientos(numCta, tipo, monto) VALUES (:numCta, :tipo, :monto)');
        $update->bindParam(':numCta', $cta);
        $update->bindParam(':tipo', $tipo);
        $update->bindParam(':monto', $monto);

        //$update->bindParam(':fecha_hora', );
        $update->execute();
        if($update->rowCount() > 0){
            echo json_encode('ok');
        }   
        else{
            echo json_encode('error');
        }
    }else{
        echo json_encode('not_exist');
    }
}catch(PDOException $e){
    echo json_encode('error');
}
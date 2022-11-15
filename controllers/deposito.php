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
        $saldo = $records->fetch(PDO::FETCH_ASSOC);
        $saldo_new = $saldo['saldo'] + $monto;
        $update = $conn->prepare('UPDATE cuenta SET saldo = :saldo WHERE numCta = :numCta');
        $update->bindParam(':saldo', $saldo_new);
        $update->bindParam(':numCta', $cta);
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
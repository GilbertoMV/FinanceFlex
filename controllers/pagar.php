<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$cta=$_POST['numCta'];
$monto=$_POST['mensualidad'];
$id_prestamo=$_POST['id'];
try{
    $update = $conn->prepare('SELECT restante FROM prestamos WHERE id_prestamo= :id_prestamo');
    $update->bindParam(':id_prestamo', $monto);
    $update->execute();
    if($update->rowCount() > 0){
        echo json_encode('ok');
    }   
    else{
        echo json_encode('error');
    }
}catch(PDOException $e){
    echo json_encode('error');
}
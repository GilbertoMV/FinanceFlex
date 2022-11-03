<?php
    require __DIR__ .'\..\includes\db.php';
    session_start();
    $id=$_GET['num_cliente'];
    $records = $conn->prepare('SELECT nom, apellidoP, apellidoM, rfc, curp, telefono, email, fechaNac FROM clientes WHERE id_cliente = :id_cliente');
    $records->bindParam(':id_cliente', $id);
    $records->execute();    
    $info = $records->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($info);
?>
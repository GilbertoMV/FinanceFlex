<?php
    require __DIR__ .'\..\includes\db.php';
    session_start();
    $records = $conn->prepare('SELECT id_cliente, nom, apellidoP, apellidoM, rfc, telefono, genero FROM clientes WHERE id_ejecutivo = :id_ejecutivo');
    $records->bindParam(':id_ejecutivo', $_SESSION['id_ejecutivo']);
    $records->execute();    
    echo json_encode($records);
?>
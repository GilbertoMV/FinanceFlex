<?php
    require __DIR__ .'\..\includes\db.php';
    session_start();
    $id=$_GET['num_cliente'];
    $set = 1;
    $records = $conn->prepare('UPDATE clientes SET status = :status WHERE id_cliente = :id_cliente');
    $records->bindParam(':status', $set);
    $records->bindParam(':id_cliente', $id);
    $records->execute();    
    if($records->rowCount() > 0){
        echo json_encode('success');
    }
    else{
        echo json_encode('error');
    }
?>
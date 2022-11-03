<?php
    require __DIR__ .'\..\includes\db.php';
    session_start();
    $id=$_GET['num_cliente'];
    $records = $conn->prepare('DELETE FROM clientes WHERE id_cliente = :id_cliente');
    $records->bindParam(':id_cliente', $id);
    $records->execute();    
    if(is_countable($records) == 0){
        echo json_encode('success');
    }
    else{
        echo json_encode('error');
    }
?>
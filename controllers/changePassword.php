<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$pass=$_POST['passNew'];
$password=password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
try{
    $records = $conn->prepare('UPDATE clientes SET password = :password WHERE id_cliente = :id_cliente');
    $records->bindParam(':password', $password);
    $records->bindParam(':id_cliente', $_SESSION['id_cliente']);
    $records->execute();
    if($records->rowCount() > 0){
        echo json_encode('ok');
    }else{
        echo json_encode('error');
    }
}catch(PDOException $e){
    echo json_encode('error');
}
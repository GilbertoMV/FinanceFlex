<?php
require __DIR__ .'\..\includes\db.php';
session_start();
$email=$_POST['email'];
$records = $conn->prepare('SELECT curp from clientes where email = :email');
$records->bindParam(':email', $email);
$records->execute();
$crp = $records->fetchAll(PDO::FETCH_ASSOC);
if($records->rowCount() > 0){
    echo json_encode($crp);
}
else{
    echo json_encode('null');
}
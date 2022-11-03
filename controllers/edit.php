<?php
    require __DIR__ .'\..\includes\db.php';
    session_start();
    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $apeP=$_POST['apellido_p'];
    $apeM=$_POST['apellido_m'];
    $tel=$_POST['tel'];
    $rfc=$_POST['rfc'];
    $curp=$_POST['curp'];
    $email=$_POST['email'];
    $fena=$_POST['fena'];
    $sql = "UPDATE clientes SET nom=:nom, apellidoP=:apellidoP, apellidoM=:apellidoM, rfc=:rfc, curp=:curp, telefono=:telefono, email=:email, fechaNac=:fechaNac WHERE id_cliente =:id_cliente";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id_cliente', $id, PDO::PARAM_INT);
    $statement->bindParam(':nom', $nom);
    $statement->bindParam(':apellidoP', $apeP);
    $statement->bindParam(':apellidoM', $apeM);
    $statement->bindParam(':rfc', $rfc);
    $statement->bindParam(':curp', $curp);
    $statement->bindParam(':telefono', $tel);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':fechaNac', $fena);
    $statement->execute();
    echo json_encode($statement);
?>
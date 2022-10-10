<?php
require __DIR__ . '\..\includes\db.php';

    session_start();
    $email = $_POST['email'];
    $pass = $_POST['password'];
    if(!empty($email) || !empty($pass))
    {
        $records = $conn->prepare('SELECT id_cliente, rfc, nom, apellidoP,
        apellidoM, curp, telefono, email, password, fechaNac, foto, id_ejecutivo FROM clientes where email=:email');
        $records->bindParam(':email', $email);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        if(is_countable($results) > 0 && password_verify($pass, $results['password'])) {
            $_SESSION['id_cliente']=$results["id_cliente"];
            $_SESSION['rfc']=$results["rfc"];
            $_SESSION['nom']=$results["nom"];
            $_SESSION['apellidoP']=$results["apellidoP"];
            $_SESSION['apellidoM']=$results["apellidoM"];
            $_SESSION['curp']=$results["curp"];
            $_SESSION['telefono']=$results["telefono"];
            $_SESSION['email']=$results["email"];
            $_SESSION['fechaNac']=$results["fechaNac"];
            $_SESSION['foto']=$results["foto"];
            $_SESSION['id_ejecutivo']=$results["id_ejecutivo"];
            echo json_encode('ok');
        }
        else{
            echo json_encode('Datos incorrectos o vacio');
        }
    }else{
        echo json_encode('Datos vacios');
    }

sleep(1);
?>
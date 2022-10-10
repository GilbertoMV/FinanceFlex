<?php
require __DIR__ . '\..\includes\db.php';

    session_start();
    $email = $_POST['emailAdmin'];
    $pass = $_POST['passwordAdmin'];
    if(!empty($email) || !empty($pass))
    {
        $records = $conn->prepare('SELECT id_ejecutivo, nom, num_ejecutivo, email, password FROM ejecutivos where email=:email');
        $records->bindParam(':email', $email);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        if(is_countable($results) > 0 && password_verify($pass, $results['password'])) {
            $_SESSION['id_ejecutivo']=$results["id_ejecutivo"];
            $_SESSION['nombre']=$results["nom"];
            $_SESSION['num_ejecutivo']=$results["num_ejecutivo"];
            error_log($_SESSION['num_ejecutivo']);
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
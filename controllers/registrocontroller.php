<?php
require __DIR__ .'\..\includes\db.php';

    session_start();
    $id_ejecutivo=$_SESSION['id_ejecutivo'];
    $nombres = $_POST['nombres'];
    $apellidop = $_POST['apellidoP'];
    $apellidom = $_POST['apellidoM'];
    $correo = $_POST['correo'];
    $tel = $_POST['telefono'];
    $curp = $_POST['curp'];
    $fechan = $_POST['fechaN'];
    $rfc = $_POST['rfc'];
    $idgenero = $_POST['genero'];
    $email = $_POST['correo'];
    $pass = $_POST['password'];
    echo $correo;
    $getEmail = $conn->prepare("SELECT email FROM usuarios WHERE email = :email");
    $getEmail->bindParam(':email', $correo);
    $getEmail->execute();
    if($getEmail->rowCount() > 0){
        echo "Ya esta registrado este email";
        header('Location: ../ejecutivo/index.php');
    }else{
        echo "no registrado este email";
        header('Location: ../ejecutivo/index.php');       
        $password=password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        try{
            $registrar=$conn->prepare('INSERT INTO usuarios(rfc, nombres, apellidoP, apellidoM, curp, telefono, email, password, fechaNac, id_genero, id_ejecutivo) VALUES(:rfc, :nombres, :apellidoP, :apellidoM, :curp, :telefono, :email, :password, :fechaNac, :id_genero, :id_ejecutivo)');
            $registrar->execute([
                'rfc' => $rfc,
                'nombres' => $nombres,
                'apellidoP' => $apellidop,
                'apellidoM' => $apellidom,
                'curp' => $curp,
                'telefono' => $tel,
                'email' => $email,
                'password' => $password,
                'fechaNac' => $fechan,
                'id_genero'=> $idgenero,
                'id_ejecutivo' => $id_ejecutivo
            ]);
            print_r($registrar);
            if($registrar->rowCount() > 0){
                echo "cliente registrado";
                print_r($registrar);
                header('Location: ../ejecutivo/index.php');

            }else{
                echo "error registrando cliente";
                print_r($registrar);
                header('Location: ../ejecutivo/index.php');
            }
        }catch(PDOException $e){
            echo $e;
        }
    }
?>
    
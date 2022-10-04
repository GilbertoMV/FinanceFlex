<?php
require __DIR__ .'\..\includes\db.php';
require __DIR__ .'\loginadmin.php';
$id_ejecutivo=$_SESSION['id_ejecutivo'];
if(!empty($_POST['registrar'])){
    $_POST['nombres'] = $nombres;
    $_POST['apellidoP'] = $apellidop;
    $_POST['apellidoM'] = $apellidom;
    $_POST['correo'] = $correo;
    $_POST['telefono'] = $tel;
    $_POST['curp'] = $curp;
    $_POST['fechaN'] = $fechan;
    $_POST['rfc'] = $rfc;
    $_POST['genero'] = $idgenero;
    $_POST['email'] = $email;
    $_POST['pass'] = $pass;
    $_SESSION['id_ejecutivo'] = $idEje;
    $getEmail = $conn->prepare("SELECT email FROM usuarios WHERE email = :email");
    $getEmail->bindParam(':email', $_POST['email']);
    $getEmail ->execute();
    if(is_countable($getEmail) > 0){
        header('Location: ../ejecutivo/index.php');
        echo('Ya esta registrado este email');
    }else{        
        $password=password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        $registrar=$conn->prepare('SELECT INTO usuarios VALUES(:rfc, :nombres, :apellidoP, :apellidoM, :curp, :telefono, :email, :password, :fechaNac, :id_genero, :id_ejecutivo)');
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
            'id_ejecutivo' => $idEje 
        ]);
        if($registrar->rowCount()){
            echo "cliente registrado";
        }else{
            echo "error registrando cliente";
        }
    }

}

    
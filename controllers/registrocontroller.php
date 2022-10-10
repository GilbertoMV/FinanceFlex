<?php
require __DIR__ .'\..\includes\db.php';


    session_start();
    error_log("REGISTROCONTROLLER");
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
    //VERIFICAR EXISTENCIA DE EMAIL EN DB
    $getEmail = $conn->prepare("SELECT email FROM clientes WHERE email = :email");
    $getEmail->bindParam(':email', $correo);
    $getEmail->execute();
    //VERIFICAR EXISTENCIA DE RFC EN DB
    $getRFC = $conn->prepare("SELECT rfc FROM clientes WHERE rfc = :rfc");
    $getRFC->bindParam(':rfc', $rfc);
    $getRFC->execute();
    //VERIFICAR EXISTENCIA DE CURP EN DB
    $getCurp = $conn->prepare("SELECT curp FROM clientes WHERE curp = :curp");
    $getCurp->bindParam(':curp', $curp);
    $getCurp->execute();
    if($getEmail->rowCount() > 0){
        echo json_encode('email_exist');
    }else if($getRFC->rowCount() > 0){   
        echo json_encode('rfc_exist');
    }else if($getCurp->rowCount() > 0){ 
        echo json_encode('curp_exist');
    }else if($getEmail->rowCount() > 0 || $getRFC->rowCount() > 0 || $getCurp->rowCount() > 0){ 
        echo json_encode('info_exist');
    }else{   
        $password=password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        try{
            $registrar=$conn->prepare('INSERT INTO clientes(rfc, nom, apellidoP, apellidoM, curp, telefono, email, password, fechaNac, id_genero, id_ejecutivo) VALUES(:rfc, :nombres, :apellidoP, :apellidoM, :curp, :telefono, :email, :password, :fechaNac, :id_genero, :id_ejecutivo)');
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
            $records = $conn->prepare('SELECT id_cliente FROM clientes WHERE rfc = :rfc');
            $records->bindParam(':rfc', $rfc);
            $records->execute();
            $id_cliente = $records->fetch(PDO::FETCH_ASSOC);
            $idClient=$id_cliente['id_cliente'];
            //$date=new DateTime("now", new DateTimeZone('America/Mexico_City') ); //this returns the current date time
            //$result = $date->format('Y-m-d-H-i-s');
            date_default_timezone_set('America/Mexico_city');
            $date= Date('H-i-s') ;
            $temp = explode('-',$date);
            $date = implode("",$temp);   
            $subfijo=substr($tel, 6,4);
            $numct = $date.$subfijo;  
            $registrar_cuenta=$conn->prepare('INSERT INTO cuenta(numCta, id_cliente)VALUES(:numCta,:idClient)');
            $registrar_cuenta->execute([
                'numCta'=>$numct,
                'idClient'=>$idClient
            ]);
            if($registrar->rowCount() > 0 && $records->rowCount() > 0 && $registrar_cuenta->rowCount() > 0){
                echo json_encode('ok');
            }else{
                echo json_encode('error');
            }
        }catch(PDOException $e){
            echo ($e);
        }
    }
    sleep(2);
?>
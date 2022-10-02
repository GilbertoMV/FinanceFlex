<?php
require './includes/db.php';
if(!empty($_POST['ini-admin'])){
    session_start();
    if(!empty($_POST['email']) and !empty($_POST['password'])){
        $records = $conn->prepare('SELECT clave_ejecutivo, email, password FROM ejecutivos where email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        if(is_countable($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['clave_ejecutivo']=$results["clave_ejecutivo"];
            error_log($_SESSION['clave_ejecutivo']);
            header('Location: ./ejecutivo/index.php');

        }else{
            echo("Datos incorrectos");
        }
    }
    echo('datos vacios');
}
?>
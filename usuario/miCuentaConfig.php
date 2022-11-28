<?php
session_start();
//include __DIR__ .'\..\error-log.php';


//error_log($_SESSION['id_cliente']);
if(isset($_SESSION['id_cliente'])){

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="../public/img/logito.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/mainClient.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <?php require 'nav.php'?>
<main>
    <section class="contenedores">
        <div class="c1">
            <div class="contenedor-foto">
            <h1><?php echo $_SESSION['nom']; ?></h1>
                <img src="../public/img/stockProfile.png" alt="perfil" class="editarFoto">
                <button class="subirFoto">Elegir Foto</button>
            </div>
            <div class="opciones">
                <ul class="listaOpciones">
                    <li><a class="opc check" href="miCuentaConfig.php"><i class="bi bi-person-vcard"></i> Mi Cuenta</a></li>
                    <li><a class="opc" href="configuracion.php"><i class="bi bi-person-badge"></i> Mi Perfil</a></li>
                    <li><a class="opc" href="seguridadConfig.php"> <i class="bi bi-shield-check"></i> Seguridad</a></li>
                    <li><a class="opc_CerrarCuenta" id="cerrarCuenta"> <i class="bi bi-exclamation-triangle"></i> Cerrar Cuenta</a></li>
                </ul>
            </div>
        </div>
        <div class="c2">
            <div class="c2-1">
                <h1 class="opcionTitulo"> Mi Cuenta </h1>
                <h6>Consulta información de tu cuenta.</h6>
            </div>
            <div class="c2-2">
                <div id="infoCliente" class="informacionGeneral">
                </div>
            </div>
        </div>
    </section>
</main>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../public/js/jquery-3.6.1.min.js"></script>
<script src="../public/js/alertas.js"></script>
<script src="../public/js/functions-cliente.js"></script>

</body>
</html>
<?php
}else{
    header('Location:../login.php');
}
?>
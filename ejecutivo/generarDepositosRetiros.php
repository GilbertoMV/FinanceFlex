<?php
// $id=$_POST['id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/mainEjecutive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
    <?php require 'nav.php' ?>
    <main>
        <div class="movimientos">
            <div class="depositos">
                <h1 class="titulo">DEPÓSITO</h1>
                <label for="numeroCuenta">Ingrese la cuenta:</label>
                <input id="numeroCuenta" type="text" placeholder="920344233"> <!-- Aquí se traerá la cuenta del cliente de la base de datos y se mostrará-->
                <h3>Cliente:</h3>
                <p>~Nombre del cliente~</p>
                <h3>RFC:</h3>
                <p>~RFC del cliente~</p>
                <h3>Ejecutivo:</h3>
                <p>~Nombre del ejecutivo~</p>
                <label for="montoDeposito">Ingrese el monto a depositar:</label>
                <input id="montoDeposito" type="text" placeholder="$0.00">
                <button id="depositar">Depositar</button>
                
            </div>
            <div class="retiros">
                <h1 class="titulo">RETIRO</h1>
                <label for="numeroCuenta">Ingrese la cuenta:</label>
                <input id="numeroCuenta" type="text" placeholder="920344233"> <!-- Aquí se traerá la cuenta del cliente de la base de datos y se mostrará-->
                <h3>Dinero Disponible:</h3>
                <p>~Cantidad Disponible~</p>
                <h3>Cliente:</h3>
                <p>~Nombre del cliente~</p>
                <h3>RFC:</h3>
                <p>~RFC del cliente~</p>
                <label for="montoRetiro">Ingrese el monto a retirar:</label>
                <input id="montoRetiro" type="text" placeholder="$0.00">
                <button id="retirar">Retirar</button>
            </div>
        </div>
    </main>
        
    <script src="../public/js/jquery-3.6.1.min.js"></script>
    <script src="../public/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/alertas.js"></script>
</body>
</html>
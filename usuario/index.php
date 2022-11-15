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
    <link rel="shortcut icon" href="../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/mainClient.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
<?php require 'nav.php'?>
<main>
    <section class="paneles">
        <div class="panel1">
            <div class="row1">
                <div class="contenedorh1">
                    <h1>Detalles de Saldo</h1>
                </div>
                <div class="detalles">
                    <div class="saldo">
                        <p>$2,000.00</p>
                    </div>
                    <div class="extras">
                        <div class="extras_row1">
                            <div class="contenedorh1">
                                <p>Ultimo Ingreso:</p>
                                <h5>$1,000.00</h5>
                            </div>
                        </div>
                        <div class="extras_row2">
                            <div class="contenedorh1">
                                <p>Ultimo Retiro:</p>
                                <h5>$1,000.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row2">
                <div class="head">
                    <div class="titulo">
                        <h1>Mi Prestamo</h1>
                    </div>
                    <div class="info">
                        <button id="infoPago"><i class="bi bi-info-circle"></i></button>
                    </div>
                </div>
                <div class="detalles">
                    <div class="extras">
                        <div class="extras_row1">
                            <div class="contenedorh1">
                                <p>Proximo Pago:</p>
                                <h5>$1,200.00</h5>
                            </div>
                        </div>
                        <div class="extras_row2">
                            <button class="pagar" id="pagar">Abonar Ahora</button>
                        </div>
                    </div>
                    <div class="saldo">
                        <p>$12,000.00</p>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="panel2">
            <div class="contenedorh1">
                <h1>Transacciones</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <td width="35%">Tipo</td>
                        <td width="15%">Fecha</td>
                        <td width="15%">Hora</td>
                        <td width="15%">Total</td>
                        <td width="15%">Recibo</td>
                    </tr>
                </thead>
                <tbody id="transaccion">
                    </tbody>
            </table>
        </div>
    </section>
<script src="../public/js/functions-cliente.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../public/js/jquery-3.6.1.min.js"></script>
<script src="../public/js/alertas.js"></script>
</body>
</html>
<?php
}else{
    header('Location:../login.php');
}
?>
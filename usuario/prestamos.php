<?php
session_start();
//include __DIR__ .'\..\error-log.php';

//error_log($_SESSION['id_cliente']);
if(isset($_SESSION['id_cliente'])){
    date_default_timezone_set('America/Mexico_City');

?><!DOCTYPE html>
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
<?php require 'nav.php'?>
<main>
    <div class="paneles">
        <div class="panel1">
        <div class="row1">
                <div class="contenedorh1">
                    <h1>Mi Prestamo</h1>
                </div>
                <div class="detalles">
                    <div class="extras">
                        <div class="extras_row1">
                            <div class="contenedorh1">
                                <p>Proximo Pago:</p>
                                <h5><?php echo $fechaActual = date('y-m-d');?></h5>
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
            <div class="row1">
                <div class="head">
                    <div class="titulo">
                        <h1>Solicitar</h1>
                    </div>
                    <div class="info">
                        <button id="infoSolicitar"><i class="bi bi-info-circle"></i></button>
                    </div>
                </div>
                <a href="#" class="hero__cta">Join us!</a>
                    <section class="modal1">
                        <div class="modal__container">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-4 ab">
                                        <h2 class="h2">Simulador de Prestamos</h2>
                                        <form id="datos_prestamo" target="_blank" method="post">
                                        <div class="form-group mt-2 mb-3">
                                            <label for="monto">Monto</label>
                                            <input name="monto" type="text" class="form-control" id="monto" placeholder="Ingresar monto">
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="tiempo">Elige los Plazos</label>
                                            <select class="form-select" id="tiempo" name="tiempo">
                                                <option value="6" selected>6 Meses</option>
                                                <option value="9">9 Meses</option>
                                                <option value="12">12 Meses</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2 mb-3 alert alert-danger" hidden id="alert-error">
                                            Debes llenar todos los campos!
                                        </div>
                                        <div class="form-group mt-1 mb-3 alert alert-success">
                                            El interés para 6 meses es de 3%. <br>
                                            El interés para 9 meses es de 5%. <br>
                                            El interés para 12 meses es de 7%. <br>
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-primary" id="btnCalcular">Calcular</button>
                                            <button formaction="../controllers/pdfClient.php" class="btn btn-danger">PDF</button>
                                            <button type="button" class="btn btn-primary" id="solicitarPrestamo">Solicitar</button>
                                        </form>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger modal__close">Cerrar</button>
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-8">
                                        <table id="lista-tabla" class="table">
                                            <thead>
                                                <tr>
                                                    <th  class="thT">Fecha</th>
                                                    <th  class="thT">Amortización</th>
                                                    <th  class="thT">Interés</th>
                                                    <th  class="thT">Cuota</th>
                                                    <th  class="thT">Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
        <div class="panel2">
            <div class="contenedorh1">
                <h1>Detalles</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <td class="tr" width="10%">Tipo</td>
                        <td class="tr" width="15%">Fecha</td>
                        <td class="tr" width="15%">Hora</td>
                        <td class="tr" width="15%">Total</td>
                        <td class="tr" width="15%">Recibo</td>
                    </tr>
                </thead>
                <tbody id="pagos">
                </tbody>
            </table>
        </div>
    </div>
</main>
<!-- <script src="../public/js/functions-cliente.js"></script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../public/js/jquery-3.6.1.min.js"></script>
<script src="../public/js/alertas.js"></script>
<script src="../public/js/dayjs.min.js"></script>
<script src="../public/js/aleman.js"></script>
<script src="../public/js/modalSimulador.js"></script>
</body>
</html>
<?php
}else{
    header('Location:../login.php');
}
?>


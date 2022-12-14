<?php
session_start();
//include __DIR__ .'\..\error-log.php';


//error_log($_SESSION['id_cliente']);
if(isset($_SESSION['id_cliente'])){
require __DIR__ .'\..\includes\db.php';

$records = $conn->prepare('SELECT foto FROM clientes where id_cliente=:id_cliente');
$records->bindParam(':id_cliente', $_SESSION['id_cliente']);
$records->execute();
$results = $records->fetch(PDO::FETCH_ASSOC);
if($results['foto'] == '' or $results['foto'] == 'NULL'){
    $results="null";
}else{
    $results;
}

$sql = $conn->prepare('SELECT cuenta.numCta, cuenta.saldo FROM clientes INNER JOIN cuenta ON clientes.id_cliente = cuenta.id_cliente WHERE cuenta.id_cliente = :id_cliente');
$sql->bindParam(':id_cliente', $_SESSION['id_cliente']);
$sql->execute();
$infocl = $sql->fetch(PDO::FETCH_ASSOC);
//VALIDAR PRESTAMOS ACTIVOS
$status = 1;
$valida = $conn->prepare('SELECT * FROM prestamos WHERE numCta = :numCta AND status = :status');
$valida->bindParam(':numCta', $infocl['numCta']);
$valida->bindParam(':status', $status);
$valida->execute();
$infopr = $valida->fetch(PDO::FETCH_ASSOC);
//PROXIMO PAGO
if($valida->rowCount() > 0){
if($infopr['interes'] == 3.00){
    $meses=6;
}
if($infopr['interes'] == 5.00){
    $meses=9;
}
if($infopr['interes'] == 7.00){
    $meses=12;
}
$mensualidad = $infopr['monto'] / $meses;
}
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
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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
                    <div id="saldo_actual"class="saldo">
                    </div> 
                    <div class="extras">
                        <div class="extras_row1">
                            <div id="deposito" class="contenedorh1">
                            </div>
                        </div>
                        <div class="extras_row2">
                            <div id="retiro" class="contenedorh1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($valida-> rowCount()>0){?>
            <div class="row2">
                <div class="head">
                    <div class="titulo">
                        <h1>Mi Pr??stamo</h1>
                    </div>
                    <div class="info">
                        <button id="infoPago"><i class="bi bi-info-circle"></i></button>
                    </div>
                </div>
                <div class="detalles">
                    <div class="extras">
                        <div class="extras_row1">
                            <div class="contenedorh1">
                                <p>Pr??ximo Pago:</p>
                                <h5>$<?php echo round($mensualidad, 2)?></h5>
                            </div>
                        </div>
                        <div class="extras_row2">
                            <button onclick='pagar("<?php echo $mensualidad;?>" , "<?php echo $infocl["saldo"];?>" , 
                            "<?php echo $infopr["id_prestamo"];?>" , 
                            "<?php echo $infocl["numCta"];?>" , 
                            "<?php echo $_SESSION["email"];?>")' class="pagar" id="pagar">Abonar Ahora</button>
                        </div>
                    </div>
                    <div class="saldo">
                        <p>$<?php echo $infopr['restante']?></p>
                    </div>
                </div>
                <?php }else{?>
                    <div class="row1">
                        <div class="head">
                            <div class="titulo">
                                <h1>Solicitar</h1>
                            </div>
                            <div class="info">
                                <button id="infoSolicitar"><i class="bi bi-info-circle"></i></button>
                            </div>
                        </div>
                        <div class="bannerPrestamo">
                            <div>
                                <p class="pText">A??n no cuentas con un pr??stamo FinanceFlex, ????Qu?? esperas?!</p> 
                            </div>
                            <div>
                                <input type="hidden" id="email" value="<?php echo $_SESSION["email"];?>"/>
                                <button class="hero__cta button-85">??SOLIC??TALO AHORA!</button>
                            </div>
                        </div>
                            <section class="modal1">
                                <div class="modal__container">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-lg-4 ab">
                                                <h2 class="h2">Simulador de Pr??stamos</h2>
                                                <form id="datos_prestamo" name="datos" target="_blank" method="post">
                                                    <div class="form-group mt-2 mb-3">
                                                        <label for="monto">Monto</label>
                                                        <input name="monto" type="text" class="form-control" id="monto" placeholder="Ingresar monto" required>
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
                                                        El inter??s para 6 meses es de 3%. <br>
                                                        El inter??s para 9 meses es de 5%. <br>
                                                        El inter??s para 12 meses es de 7%. <br>
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="button" class="btn btn-warning" id="btnCalcular">Calcular</button>
                                                        <button formaction="../controllers/pdfClient.php" class="btn btn-danger">PDF</button>        
                                                </form>
                                                <button type="button" class="btn btn-success" id="solicitarPrestamo">Solicitar</button>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-primary modal__close">Cerrar</button>
                                            </div>
                                        </div>
                                            <div class="col-12 col-sm-12 col-lg-8">
                                                <table id="lista-tabla" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th  class="thT">Fecha</th>
                                                            <th  class="thT">Amortizaci??n</th>
                                                            <th  class="thT">Inter??s</th>
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
            <?php }?>
        </div>
        </div>
            
        <div class="panel2">
            <div class="contenedorh1">
                <h1>Transacciones</h1>
            </div>
            <table id=tabla-transacciones>
                <thead>
                    <tr>
                        <th class="tr" width="10%">Tipo</th>
                        <th class="tr" width="15%">Fecha</th>
                        <th class="tr" width="15%">Hora</th>
                        <th class="tr" width="15%">Total</th>
                    </tr>
                </thead>
                <tbody id="transaccion">
                </tbody>
            </table>
        </div>
    </section>

    <script type="text/javascript" src="../public/js/tableclient.js"></script>
    <script src="../public/js/functions-cliente.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
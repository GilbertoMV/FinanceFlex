<?php
session_start();
//include __DIR__ .'\..\error-log.php';
//error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION['id_ejecutivo'])){
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="../public/img/logito.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/mainEjecutive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
    <?php require 'nav.php'?>
    <main>
        <div class="main">
            <div>
                <input type="hidden" id="id_cl" value="<?php echo $_POST['id']?>">
                <h1 class="title">Lista de Pagos</h1>
                <h1 class="title">
                </h1>
            </div>
            <div class="colum2">
                <div class="buscar">
                    <input type="text" name="buscador" id="buscador" placeholder="Buscar">
                    <div class="btn1">
                        <i class="fas fa-search icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <section class="container__table-clients">
            <table id="tabla-pagos" class="clients__table" id=tabla border="0" cellspacing="0">
                <thead>
                    <tr class="encabezado_clientes">
                        <th width="10%">Id Pago</th>
                        <th width="20%">Monto de Pago</th>
                        <th width="10%">Fecha de Pago</th>
                        <th width="20%">Hora de Pago</th>
                        <th width="20%">Prestamo</th>
                        <th width="20%">Estado</th>
                    </tr>
                </thead>
                        <tbody id="datos_cliente">
                    </tbody>
            </table>
        </section>
    </main>
    <script src="../public/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/alertas.js"></script>
    <script src="../public/js/functions-ejecutivo.js"></script>
    <!--<script type="text/javascript" src="../public/js/datatable.js"></script>-->

</body>
</html>
<?php
}else{
    header('Location:../login.php');
}
?>
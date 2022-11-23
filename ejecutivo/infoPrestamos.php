<?php
session_start();
//include __DIR__ .'\..\error-log.php';
//error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION['id_ejecutivo'])){
    $id=$_POST['id'];
    require_once __DIR__ .'\..\includes\db.php';
    $consulta2 = $conn->prepare('SELECT prestamos.id_prestamo, prestamos.numCta, prestamos.monto, prestamos.interes, prestamos.status, prestamos.fechaInicial, prestamos.fechaTermino FROM prestamos INNER JOIN cuenta ON prestamos.numCta = cuenta.numCta WHERE cuenta.id_cliente = :id_cliente');
    $consulta2->bindParam(':id_cliente', $id);
    $consulta2->execute();
    $prestamos = $consulta2->fetchAll(PDO::FETCH_ASSOC);

    $consulta1 = $conn->prepare('SELECT nom FROM clientes WHERE id_cliente = :id_cliente');
    $consulta1->bindParam(':id_cliente', $id);
    $consulta1->execute();  
    $res=$consulta1->fetch(PDO::FETCH_ASSOC);
    //NUMCUENTA
    $consulta3 = $conn->prepare('SELECT cuenta.numCta FROM cuenta INNER JOIN clientes ON cuenta.id_cliente = clientes.id_cliente WHERE clientes.id_cliente = :id_cliente');
    $consulta3->bindParam(':id_cliente', $id);
    $consulta3->execute();
    $num = $consulta3->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
    <?php require 'nav.php'?>
    <main>
        <div class="main">
            <div>
                <h1 class="title">Lista de Prestamos</h1>
                <h2 class="infocliente">CLIENTE: <?php echo $res['nom']; ?></h2>
                <h2 class="infocliente">NUMERO DE CUENTA: <?php echo $num['numCta']; ?></h2>
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
            <table class="clients__table" id=tabla border="0" cellspacing="0">
                <thead>
                    <tr class="encabezado_clientes">
                        <th width="10%">Id Prestamo</th>
                        <th width="20%">Monto Prestamo</th>
                        <th width="10%">Interés Anual</th>
                        <th width="20%">Fecha de Inicio</th>
                        <th width="20%">Fecha de Termino</th>
                        <th width="20%">Tabla de Amortización</th>
                    </tr>
                </thead>
                        <tbody id="datos_cliente">
                        <?php foreach ($prestamos as $prestamo){?>

                            <tr>

                                <td class="lista_clientes"><?php echo $prestamo['id_prestamo']; ?></td>
                                <td class="lista_clientes"><?php echo $prestamo['monto']; ?></td>
                                <td class="lista_clientes"><?php echo $prestamo['interes']; ?></td>
                                <td class="lista_clientes"><?php echo $prestamo['fechaInicial']; ?></td>
                                <td class="lista_clientes"><?php echo $prestamo['fechaTermino']; ?></td>
                                <td class="lista_clientes buttons_clientes">
                                    <form method="post" target="_blank" action="../controllers/pdf.php">
                                        <input type="hidden" name="id" value="<?php echo $id;?>"/>
                                        <input type="hidden" name="idPrestamo" value="<?php echo $prestamo['id_prestamo'];?>"/>
                                        <?php if ($prestamo['status'] === '1'){ ?>
                                        <button class="pdf"><i class="bi bi-filetype-pdf"> Descargar PDF</i></button>
                                        <?php }else{?>
                                            <button class="pagado"><i class="bi bi-filetype-pdf">Prestamo pagado</i></button>
                                        <?php }?>
                                    </form>
                            </td> 
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </section>
    </main>
    <script type="text/javascript" src="../public/js/datatable.js"></script>
    <script src="../public/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/alertas.js"></script>
</body>
</html>
<?php
}else{
    header('Location:../login.php');
}
?>
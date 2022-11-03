<?php
session_start();
include __DIR__ .'\..\error-log.php';
error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION['id_ejecutivo'])){
    require_once __DIR__ .'\..\includes\db.php';
    $records = $conn->prepare('SELECT id_cliente, nom, apellidoP, apellidoM, rfc, telefono, genero FROM clientes WHERE id_ejecutivo = :id_ejecutivo');
    $records->bindParam(':id_ejecutivo', $_SESSION['id_ejecutivo']);
    $records->execute();    
    $resultado = $records->fetchAll(PDO::FETCH_ASSOC);
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
                <h1 class="title">Lista de clientes</h1>
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
                        <th>id</th>
                        <th width="25%">Nombre Cliente</th>
                        <th width="10%">Genero</th>
                        <th width="20%">RFC</th>
                        <th>Teléfono</th>
                        <th width="30%">Acciones</th>
                    </tr>
                </thead>
                        <tbody>
                        <?php foreach ($resultado as $resultado){?>
                            <tr>
                                <td class="lista_clientes"><?php echo $resultado['id_cliente'];?></td>
                                <td class="lista_clientes"><?php echo $resultado['nom'].' '. $resultado['apellidoP'].' '. $resultado['apellidoM'];?></td>
                                <td class="lista_clientes"><?php echo $resultado['genero']; ?></td>
                                <td class="lista_clientes"><?php echo $resultado['rfc'];?></td>
                                <td class="lista_clientes"><?php echo $resultado['telefono'];?></td>
                                <td class="lista_clientes buttons_clientes">
                                <button class="info"><i class="bi bi-info-circle"> Más</i></button>
                                <button onclick="edit(<?php echo $resultado['id_cliente']; ?>)"class="editar"><i class="bi bi-pencil-square"> Editar</i></button>
                                <button class="eliminar"><i class="bi bi-person-x"> Eliminar</i></button>
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
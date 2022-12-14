<?php
session_start();
//include __DIR__ .'\..\error-log.php';
//error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION["id_ejecutivo"])){
    require_once __DIR__ .'\..\includes\db.php';
    $records = $conn->prepare('SELECT id_cliente, nom, apellidoP, apellidoM FROM clientes WHERE id_ejecutivo = :id_ejecutivo');
    $records->bindParam(':id_ejecutivo', $_SESSION['id_ejecutivo']);
    $records->execute();    
    $results = $records->fetchAll(PDO::FETCH_ASSOC);


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
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
    <header class="header">
        <?php require 'nav.php' ?>
    </header>
    <main>
        <div class="tablaMod">
            <table>
                <tr class="cabeceraTablaMod">
                    <th width="30%">Número Cliente</th>
                    <th witdth="20%">Nombre</th>
                    <th width="30%">Apellidos</th>
                    <th width="20%">Acciones</th>
                </tr>
                <?php foreach ($results as $result){?>
                <tr class="cuerpoTablaMod">
                    <td><?php echo $result['id_cliente'];?></td>
                    <td><?php echo $result['nom'];?></td>
                    <td><?php echo $result['apellidoP'] . ' ' . $result['apellidoM'];?></td>
                    <td><input type="button" value="Modificar" class="btn-tabla"></input></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </main>
</body>
</html>
<?php
}else
{
    header('Location:../login.php');


}
?>
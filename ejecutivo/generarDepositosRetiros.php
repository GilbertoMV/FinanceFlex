<?php
session_start();
//include __DIR__ .'\..\error-log.php';
//error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION['id_ejecutivo'])){
    $id=$_POST['id'];
    require_once __DIR__ .'\..\includes\db.php';
    $sql = $conn->prepare('SELECT cuenta.numCta, clientes.nom, clientes.apellidoP, clientes.apellidoM, clientes.rfc, cuenta.saldo FROM clientes INNER JOIN cuenta ON clientes.id_cliente = cuenta.id_cliente WHERE cuenta.id_cliente = :id_cliente');
    $sql->bindParam(':id_cliente', $id);
    $sql->execute();
    $infocl = $sql->fetch(PDO::FETCH_ASSOC);

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
</head>
<body>
    <?php require 'nav.php' ?>
    <main>
        <div class="movimientos">
            <div class="depositos">
                <h1 class="titulo">DEPÓSITO</h1>
                    <label for="numeroCuenta">Ingrese la cuenta:</label>
                    <form id="datos_Deposito">
                        <input id="numeroCuenta" type="text" placeholder="920344233" name="numcta" value="<?php echo $infocl['numCta'];?>">
                        <h3>Cliente:</h3>
                        <p><?php echo $infocl['nom'].' '.$infocl['apellidoP'].' '.$infocl['apellidoM'] ?></p>
                        <h3>RFC:</h3>
                        <p><?php echo $infocl['rfc'];?></p>
                        <h3>Ejecutivo:</h3>
                        <p><?php echo $_SESSION['nombre']?></p>
                        <label for="montoDeposito">Ingrese el monto a depositar:</label>
                        <input id="montoDeposito" name="monto" type="text" placeholder="$0.00">
                    </form>
                    <button id="depositar">Depositar</button>
                
            </div>
            <div class="retiros">
                <h1 class="titulo">RETIRO</h1>
                <label for="numeroCuenta">Ingrese la cuenta:</label>
                <form id="datos_Retiro">
                    <input id="numeroCuenta_Retiro" name="numcta" type="text" placeholder="920344233" value="<?php echo $infocl['numCta'];?>"> <!-- Aquí se traerá la cuenta del cliente de la base de datos y se mostrará-->
                    <h3>Dinero Disponible:</h3>
                    <p><?php echo '$'.$infocl['saldo'];?></p>
                    <h3>Cliente:</h3>
                    <p><?php echo $infocl['nom'].' '.$infocl['apellidoP'].' '.$infocl['apellidoM'] ?></p>
                    <h3>RFC:</h3>
                    <p><?php echo $infocl['rfc'];?></p>
                    <label for="montoRetiro">Ingrese el monto a retirar:</label>
                    <input id="montoRetiro" name="monto" type="text" placeholder="$0.00">
                </form>
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
<?php
}else{
    header('Location:../login.php');
}
?>
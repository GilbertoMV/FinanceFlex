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
            <form id="form" method="POST" action="" enctype="multipart/form-data" class="form">
                    <?php if($results == 'null'){?>
                    <img src="../public/img/stockProfile.png" alt="perfil" class="editarFoto">
                    <?php }else{?> 
                        <img src="<?php echo $results['foto']; ?>" alt="perfil" class="editarFoto">
                        <?php }?>
                    <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                    <label for="file-1" class="fotoload">
                        <span><i class="bi bi-cloud-arrow-up"></i> Escoge una foto...</span>
                    </label>
                    <button id="subir" class="subirFoto">Cambiar Foto</button>
                </form>
            </div>
            <div class="opciones">
                <ul class="listaOpciones">
                    <li><a class="opc" href="miCuentaConfig.php"><i class="bi bi-person-vcard"></i> Mi Cuenta</a></li>
                    <li><a class="opc" href="configuracion.php"><i class="bi bi-person-badge"></i> Mi Perfil</a></li>
                    <li><a class="opc check" href="seguridadConfig.php"> <i class="bi bi-shield-check"></i> Seguridad</a></li>
                    <li><a class="opc_CerrarCuenta" id="cerrarCuenta"> <i class="bi bi-exclamation-triangle"></i> Cerrar Cuenta</a></li>
                </ul>
            </div>
        </div>
        <div class="c2">
            <div class="c2-1">
                <h1 class="opcionTitulo"> Seguridad </h1>
                <h6>Modifica tus Credenciales</h6>
            </div>
            <div class="c2-2">
                <div class="informacionGeneral">
                    <p>Información de Seguridad</p>
                    <form action="">
                    <label for="correo">Correo Electronico:</label>
                    <input class="editInfo" id="email" name="correo" type="text" value="<?php echo $_SESSION['email'] ?>" disabled>
                    <label for="rfc">Contraseña Actual:</label>
                    <input class="editInfo" id="passOld" name="rfc" type="password" placeholder="Ingrese su contraseña actual..." required>

                    <div class="colums">
                        <div>
                            <label for="nContra">Contraseña Nueva:</label>
                            <input class="editInfo" id="passNew"name="nContra" type="password" placeholder="Ingrese la contraseña Nueva..." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 8 o más caracteres." required>
                        </div>
                        <div>
                            <label for="nContra1">Repita la Contraseña:</label>
                            <input class="editInfo" id="passValid" name="nContra1" type="password" placeholder="Repita la contraseña Nueva..." required>
                        </div>
                    </div>
                    </form>
                    <button class="actuInfo" id="ActualizarCredencialesCliente">Guardar Datos</button>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../public/js/alertas.js"></script>

</body>
</html>
<?php
}else{
    header('Location:../login.php');
}
?>
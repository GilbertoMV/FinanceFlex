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
    <link rel="shortcut icon" href="../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/mainEjecutive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
        <?php require 'nav.php'?>
    <main>
        <!-- <h1>Foto</h1>
        <div class="lineaR"></div>
        <div class="loadphoto">
            <img src="../public/img/profile.png" alt="foto de perfil">
            <button class="contenedor-btn-file">
                Subir foto <?php     //print_r($results);?>
                <label for="btn-file"></label>
                <input type="file" id="btn-file">
            </button>
        </div> -->
        <h1>Nuevo Cliente</h1>
        <div class="lineaR"></div>
        <div class="contenedor-formulario">
        <div id="InfoBanner" style="">
            
        </div>
            <form id="registroclients">
                <div class="bloque">
                    <label for="nombres" class="labels">Nombre(s)</label>
                    <p class="lineaF"></p>
                    <input type="text" name="nombres" id="nombres" class="inputs center" required>
                </div>
                <div class="bloque">
                    <label for="apellidoM" class="labels">Apellido Paterno</label>
                    <p class="lineaF"></p>
                    <input type="text" name="apellidoP" id="apeP" class="inputs center" required>
                </div>
                <div class="bloque">
                    <label for="apellidoP" class="labels">Apellido Materno</label>
                    <p class="lineaF"></p>
                    <input type="text" name="apellidoM" id="apeM" class="inputs center" required>
                </div>
                <div class="bloque">
                    <label for="email" class="labels">Correo</label>
                    <p class="lineaF"></p>
                    <input type="email" name="correo" id="email" class="inputs center" required>
                </div>
                <div class="bloque">
                    <label for="telefono" class="labels">Numero de teléfono</label>
                    <p class="lineaF"></p>
                    <input type="text" name="telefono" id="Ntelefono" class="inputs center" required>
                </div>
                <div class="bloque">
                    <label for="CURP" class="labels ">CURP</label>
                    <p class="lineaF"></p>
                    <input type="text" name="curp" id="curp" class="inputs center" required>
                </div>
                <div class="bloque">
                    <label for="echaN" class="labels">Fecha de Nacimiento</label>
                    <p class="lineaF"></p>
                    <input type="date" name="fechaN" id="fechaN" class="inputs center" required>
                </div class="bloque">
                <div class="di bloque">
                    <label for="password" class="labels">Password</label>
                    <p class="lineaF"></p>
                    <input type="password" name="password" id="password" class="inputs" autocomplete="off" required>
                </div>
                <div class="bloque">
                    <label for="rfc" class="labels">RFC</label>
                    <p class="lineaF"></p>
                    <input type="text" name="rfc" id="rfc" class="inputs" required>
                </div>
                <div class="bloque">    
                    <label for="genero" class="labels">GENERO</label>
                    <p class="lineaF"></p>
                    <select name="genero" id="" class="inputSelect" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
                <div class="bloque">
                    <input type="submit" nombre="registrar" id="registrar" value="Dar de Alta" class="contenedor-btn-file">
                </div>
            </form>
        </div>
        <div class="contenedor-loader">
            <div class="ids-roller">

                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <img class="logo" src="../public/img/logito.png" alt="">

            </div>
        </div>
    </main> 
    <script src="../public/js/app.js"></script>
</body>
</html>
<?php
}else{
    header('Location:../login.php');


}
?>
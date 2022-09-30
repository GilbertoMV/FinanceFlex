<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>/public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>/public/css/mainEjecutive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <script defer src="<?php echo constant('URL'); ?>/public/js/navbar.js"></script>
</head>
<body>
    <header class="header">
        <img class="logo" src="<?php echo constant('URL'); ?>/public/img/logito.png" alt="">
        <h1 class="h1">
            <a href="<?php echo constant('URL'); ?>" class="a">EJECUTIVOS<br><span>FinanceFlex</span></a>

        </h1>
        <nav class="nav">
            <div class="container">
                <ul class="ul">
                    <li class="li"><a href="<?php echo constant('URL'); ?>index.php" class="a">Dar de alta</a></li>
                    <li class="li"><a href="modificaciones.html" class="a">Modificaciones</a></li>
                    <li class="li"><a href="darBaja.html" class="a">Dar de Baja</a></li>
                    <li class="li"><a href="prestamos.html" class="a">Prestamos</a></li>
                    <li class="li"><a href="pagos.html" class="a">Pagos</a></li>
                    <li class="li"><a href="depositosRetiros.html" class="a">Depositos y Retiros</a></li>
                    <li><a href="#" ></a><img src="<?php echo constant('URL'); ?>/public/img/profile.png" alt="perfil" class="logo"></li>
                </ul>
            </div>
        </nav>
    <div class="linea"></div>
    </header>
    <main>
        <h1>Foto</h1>
        <div class="lineaR"></div>
        <div class="loadphoto">
            <img src="<?php echo constant('URL'); ?>/public/img/profile.png" alt="foto de perfil">
            <button class="contenedor-btn-file">
                Subir foto
                <label for="btn-file"></label>
                <input type="file" id="btn-file">
            </button>
        </div>
        <h1>Datos</h1>
        <div class="lineaR"></div>
        <div class="contenedor-formulario">
            <form action="">
                <div class="bloque">
                    <label for="nombres" class="labels">Nombre(s)</label>
                    <p class="lineaF"></p>
                    <input type="text" name="Nombres" id="nombres" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="apellidoM" class="labels">Apellido Materno</label>
                    <p class="lineaF"></p>
                    <input type="text" name="ApellidoM" id="apeM" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="apellidoP" class="labels">Apellido Paterno</label>
                    <p class="lineaF"></p>
                    <input type="text" name="ApellidoM" id="apeM" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="email" class="labels">Correo</label>
                    <p class="lineaF"></p>
                    <input type="email" name="correo" id="email" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="telefono" class="labels">Numero de teléfono</label>
                    <p class="lineaF"></p>
                    <input type="text" name="telefono" id="Ntelefono" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="CURP" class="labels ">CURP</label>
                    <p class="lineaF"></p>
                    <input type="text" name="CURP" id="curp" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="echaN" class="labels">Fecha de Nacimiento</label>
                    <p class="lineaF"></p>
                    <input type="date" name="fechaN" id="fechaN" class="inputs center">
                </div class="bloque">
                <div class="di bloque">
                    <label for="Direccion" class="labels">Dirección</label>
                    <p class="lineaF"></p>
                    <input type="text" name="Direccion" id="direccion" class="inputs">
                </div>
                <div class="bloque">
                    <label for="rfc" class="labels">RFC</label>
                    <p class="lineaF"></p>
                    <input type="text" name="rfc" id="rfc" class="inputs">
                </div>
                <div class="bloque">
                    <input type="submit" value="Dar de Alta" class="contenedor-btn-file">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
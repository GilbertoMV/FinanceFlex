<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
    <header class="header">
        <img class="logo" src="../public/img/logito.png" alt="">
        <h1 class="h1">
            <a href="#" class="title-logo">FinanceFlex</a>
        </h1>
        <button class="button">
          <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>
        <?php require 'nav.php' ?>
    </header>
    <main>
        <h1>Foto</h1>
        <div class="lineaR"></div>
        <div class="loadphoto">
            <img src="../public/img/Profile.png" alt="">
            <p>ID: 2930930223</p>
            <button class="contenedor-btn-file">
                Cambiar
                <label for="btn-file"></label>
                <input type="file" id="btn-file">
            </button>
        </div>
        <h2>Información Personal</h2>
        <div class="lineaR"></div>
        <div class="person-dato">
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
                    <input type="text" name="ApelldoP" id="apeM" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="email" class="labels">Correo</label>
                    <p class="lineaF"></p>
                    <input type="email" name="correo" id="email" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="rfc" class="labels">RFC</label>
                    <p class="lineaF"></p>
                    <input type="text" name="rfc" id="rfc" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="fechaN" class="labels">Fecha de Nacimeinto</label>
                    <p class="lineaF"></p>
                    <input type="date" name="fechaN" id="fechaN" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="telefono" class="labels">Núemro de teléfono</label>
                    <p class="lineaF"></p>
                    <input type="number" name="telefono" id="Ntelefono" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="genero" class="labels">Género</label>
                    <p class="lineaF"></p>
                    <input type="text" name="genero" id="genero" class="inputs center">
                </div>
                <div class="bloque">
                    <label for="curp" class="labels">CURP</label>
                    <p class="lineaF"></p>
                    <input type="text" name="curp" id="curp" class="inputs center">
                </div>
                <div class="bloque1">
                    <a href="#">Cambiar contraseña</a>
                    <input type="submit" value="Restablecer" class="contenedor-btn-f">
                    <input type="submit" value="Guardar" class="contenedor-btn-file">
                </div>
            </form>
        </div>
    </main>
</body>
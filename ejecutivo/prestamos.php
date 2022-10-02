<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="./public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/mainEjecutive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
    <header class="header">
        <img class="logo" src="../public/img/logito.png" alt="">
        <h1 class="h1">
            <a href="#" class="a">EJECUTIVOS<br><span>FinanceFlex</span></a>
            <?php require 'nav.php' ?>
        </h1>
        <nav class="nav">
            <div class="container">
                <ul class="ul">
                    <li class="li"><a href="index.html" class="a">Dar de alta</a></li>
                    <li class="li"><a href="modificaciones.html" class="a">Modificaciones</a></li>
                    <li class="li"><a href="darBaja.html" class="a">Dar de Baja</a></li>
                    <li class="li"><a href="prestamos.html" class="a">Prestamos</a></li>
                    <li class="li"><a href="pagos.html" class="a">Pagos</a></li>
                    <li class="li"><a href="depositosRetiros.html" class="a">Depositos y Retiros</a></li>
                    <li><a href="#" ></a><img src="../public/img/profile.png" alt="perfil" class="logo"></li>
                </ul>
            </div>
            <div class="linea"></div>
        </nav>
    </header>
</body>
</html>
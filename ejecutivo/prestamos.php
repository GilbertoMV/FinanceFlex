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
        </h1>
        <?php require 'nav.php' ?>
        <div class="linea"></div>
    </header>
    <main>
        <div class="tablaPrestamos">
            <table>
                <tr class="cabeceraTablaPrestamos">
                    <th width="30%">Número Cliente</th>
                    <th witdth="20%">Cantidad</th>
                    <th width="30%">Mensualidades</th>
                    <th width="20%">Acciones</th>
                </tr>
                <tr class="cuerpoTablaMod">
                    <td>20181150</td>
                    <td>$30,000</td>
                    <td>7 meses</td>
                    <td class="buttons">
                        <button class="btn"><img src="../public/img/aprobado.png" alt=""></button>
                        <button class="btn"><img src="../public/img/rechazado.png" alt=""></button>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>
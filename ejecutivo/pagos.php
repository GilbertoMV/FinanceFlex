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
                    <th witdth="20%">Prestamo</th>
                    <th width="30%">Estado</th>
                    <th width="20%">Aceptar / Rechazar</th>
                </tr>
                <tr class="cuerpoTablaMod">
                    <td>20181150</td>
                    <td>$3,000</td>
                    <td><input type="button" value="Aprobado" class="btn-activo"></input></td>
                    <td class="buttons">
                        <button class="btn"><img src="../public/img/aprobado.png" alt=""></button>
                        <button class="btn"><img src="../public/img/rechazado.png" alt=""></button>
                    </td>
                </tr>
                <tr class="cuerpoTablaMod">
                    <td>20181150</td>
                    <td>$3,000</td>
                    <td><input type="button" value="Rechazado" class="btn-inactivo"></input></td>
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
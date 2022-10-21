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
    <header class="header">
        <?php require 'nav.php' ?>
        <div class="linea"></div>
    </header>
    <main>
        <div class="tablaBaja">
            <table>
                <tr class="cabeceraTablaBaja">
                    <th>Número Cliente</th>
                    <th>Tipo de Tramite</th>
                    <th>Estado</th>
                    <th width="20%">Rechazar / Aceptar</th>
                </tr>
                <tr class="cuerpoTablaBaja">
                    <td>20181150</td>
                    <td>Retiro</td>
                    <td><input type="button" value="Pendiente" class="btn-pendiente"></input></td>
                    <td class="buttons">
                        <button class="btn"><img src="../public/img/aprobado.png" alt=""></button>
                        <button class="btn"><img src="../public/img/rechazado.png" alt=""></button>
                    </td>
                </tr>
                <tr class="cuerpoTablaBaja">
                    <td>20181150</td>
                    <td>Depósito</td>                    
                    <td><input type="button" value="Pendiente" class="btn-pendiente"></input></td>
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
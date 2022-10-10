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
    
    <section class="prest">
        <h2>Prestamo</h2>
        <div class="line"></div>
        <div class="prest-rec">
            <div class="tuprest">
                <img src="../public/img/prst1.png" alt="">
                <div class="prestamo">
                    <h5>$6558.75</h5>
                    <p>Tu prestamo</p>
                </div>
            </div>
            <div class="abono">
                <img src="../public/img/prst2.png" alt="">
                <div class="adeudo">
                    <h5>$558.75</h5>
                    <p>Adeudo</p>
                </div>
            </div>
            <div class="solicitar">
                <a href="solicprest.php"><h2>Solicitar Prestamo</h2></a>
            </div>
            <div class="abo">
                <a href="#"><h2>Abonar</h2></a>
            </div>
        </div>
    </section>
    <section class="detalles">
        <h2>Detalles</h2>
        <div class="line"></div>
        <div class="pago">
            <h4>8 pagos de 10</h4>
            <div class="line"></div>
        </div>
        <div class="datalles">
            <table>
                <thead>
                    <tr>
                        <td></td>
                        <td>Fecha</td>
                        <td>Hora</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Abono</td>
                        <td class="chi">22 Mayo</td>
                        <td class="chi">9:00</td>
                        <td class="chi">$400</td>
                    </tr>
                    <tr>
                        <td>Abono</td>
                        <td class="chi">22 Mayo</td>
                        <td class="chi">9:00</td>
                        <td class="chi">$400</td>
                    </tr>
                    <tr>
                        <td>Abono</td>
                        <td class="chi">22 Mayo</td>
                        <td class="chi">9:00</td>
                        <td class="chi">$400</td>
                    </tr>
                </tbody>
            </table>
            <a href="#"><i class="fa-solid fa-chevron-down"></i></a>
        </div>
    </section>
</body>
</html>
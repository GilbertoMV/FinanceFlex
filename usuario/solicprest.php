<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="./public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script defer src="public/js/navbar.js"></script>
</head>
<body>
    <header class="header">
        <img class="logo" src="public/img/logito.png" alt="">
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
    <section class="deti">
        <div class="det-rec">
            <h2>Detalles</h2>
            <div class="dline"></div>
        </div>
        <div class="dettxt">
            <p>Fecha del prestamo: 27/07/2022</p>
            <p>Monto: $25,000.00</p>
        </div>
        <div class="dettxt1">
            <p>Periodo: Mensual</p>
            <p>Interés: 1.25%</p>
        </div>
        <div class="det2">
            <p>Plazos: 8</p>
        </div>
    </section>
    <section class="detalles1">
        <div class="datalles1">
            <table>
                <thead>
                    <tr>
                        <td>Fecha</td>
                        <td>Cuota</td>
                        <td>Capital</td>
                        <td>Interés</td>
                        <td>Saldo</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chi">22/08/2022</td>
                        <td class="chi">3,303.33</td>
                        <td class="chi">2,990.83</td>
                        <td class="chi">312.50</td>
                        <td class="chi">22,009.17</td>
                    </tr>
                    <tr>
                        <td class="chi">22/08/2022</td>
                        <td class="chi">3,303.33</td>
                        <td class="chi">2,990.83</td>
                        <td class="chi">312.50</td>
                        <td class="chi">22,009.17</td>
                    </tr>
                    <tr>
                        <td class="chi">22/08/2022</td>
                        <td class="chi">3,303.33</td>
                        <td class="chi">2,990.83</td>
                        <td class="chi">312.50</td>
                        <td class="chi">22,009.17</td>
                    </tr>
                </tbody>
            </table>
            <a href="#"><i class="fa-solid fa-chevron-down"></i></a>
        </div>
    </section>
</body>
</html>
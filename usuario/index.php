<?php
session_start();
include __DIR__ .'\..\error-log.php';


error_log($_SESSION['id_cliente']);
if(isset($_SESSION['id_cliente'])){

?>
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
    <!--Main section-->
    <section class="main">
        <div class="banner">
            <div class="log">
                <img src="../public/img/logito.png" alt="" >
                <h3>FinanceFlex</h3>
            </div>
            <div class="info">
                <h2>¡Solicita un prestamo!</h2>
                <p>Fácil y rápido</p>
                <button type="button"><a href="prestamos.php">Solicitar ahora</a></button>
            </div>
            <div class="imagen">
                <img src="../public/img/bannerimg.png" alt=""  class="img">
            </div>
        </div>
    </section>
    <section class="det">
        <div class="saldo">
            <h3>Detalles de Saldo</h3>
            <div class="line"></div>
            <div class="fond">
                <div class="actual">
                    <div class="vectores">
                        <img src="../public/img/vectores.png" alt="">
                    </div>
                    <div class="elipse" id="saldo"> 
                    </div>
                </div>
                <div class="ingreso">
                    <p>Ingresos</p>
                </div>
                <div class="gasto">
                    <p>Gastos</p>
                </div>
            </div>
        </div>
    </section>
    <section class="trans">
        <div class="transacciones">
            <h2>Transacciones</h2>
            <div class="linne"></div>
            <table>
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nombre</td>
                        <td>30 Agosto</td>
                        <td>9:00</td>
                        <td class="warning">$1000.00</td>
                        <td><input type="button" value="Recibo" class="btn-tabla"></input></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>30 Agosto</td>
                        <td>9:00</td>
                        <td class="safe">$500.00</td>
                        <td><input type="button" value="Recibo" class="btn-tabla"></input></a>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>30 Agosto</td>
                        <td>9:00</td>
                        <td class="warning">$609.00</td>
                        <td><input type="button" value="Recibo" class="btn-tabla"></input></td>
                    </tr>
                </tbody>
            </table>
            <a href="#"><i class="fa-solid fa-chevron-down"></i></a>
        </div>
    </section>
    <script src="../public/js/app.js"></script>
    <script>
        var saldo = document.getElementById('saldo');
        fetch(__DIR__+'../controllers/checkbalance.php').then((res)=>res.json())
        .then(response =>{
    console.log(response)
    if(response === 'null'){
        saldo.innerHTML = `
        <div class="txt">
            <h6>$0.00</h6>
            <p>Saldo Actual</p>
        </div> 

        `
    }else{
        saldo.innerHTML = `
        <div class="txt">
            <h6>$${response[0].saldo}</h6>
            <p>Saldo Actual</p>
        </div> 

        `
    }
}).catch(error => console.log(error)); 
    </script>
</body>
</html>
<?php
}else{
    header('Location:../login.php');


}
?>
<?php
//include 'error-log.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="public/img/logito.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="cont">
        <div class="navbar">
            <img src="./public/img/logo_transparent-white.png" class="logo" alt="logo">
            <nav>
                <ul id="menuList">
                    <li><a class="a" href="index.php">INICIO</a></li>
                    <li><a class="a" id="nosotros">NOSOTROS</a></li>
                    <li><a class="a" id="registro">REGISTRO</a></li>
                </ul>
            </nav>
            <img src="public/img/menu.png" class="menu" onClick="togglemenu()" alt="menu">
        </div>
        <div class="row">
            <div class="col-1">
                <h2>COMIENZA</h2>
                <h3>A ADMINISTRAR TU DINERO</h3>
                <p>con FinanceFlex</p>
                <a href="login.php" class="button">Iniciar Ya</a>
            </div>
            <div class="col-2">
                <img src="public/img/Character_1.png" class="person" alt="personaje alucivo">
                <div class="color-box"></div>
            </div>
        </div>
    </div>
    <div class="container-n">
        <section class="nosotros">
            <h1> FinanceFlex </h1>
            <p>Consigue tus objetivos a corto o largo plazo con FinanceFlex.</p>
            <h2>Con FinanceFlex Puedes:</h2>
        
            <section class="hacer">
                <div class="bloque">
                    <div class="item">
                        <img class="bloque__imagen" src="./public/img/money.png" alt="icono administrar">
                        <h1>Administrar</h1>
                        <p>Consigue tus metas de ahorro, administrando y moviendo tu dinero dentro de FinanceFlex.</p>
                    </div>
                </div>
                <div class="col-1-item">
                    <div class="item">
                        <img class="bloque__imagen" src="./public/img/deposit.png" alt="icono depositar">
                        <h1>Depositar</h1>
                        <p>Ingresa dinero a tu cuenta de ahorro para así conseguir tus metas deseadas.</p>
                    </div>
                </div>
                <div class="col-1-item">
                    <div class="item">
                        <img class="bloque__imagen" src="./public/img/fees.png" alt="icono solicitar">
                        <h1>Solicitar</h1>
                        <p>Solicita prestamos para conseguir tus metas con plazos flexibles e intereses minimos.</p>
                    </div>
                </div>
                <div class="col-1-item">
                    <div class="item">
                        <img class="bloque__imagen" src="./public/img/growth.png" alt="icono pagar">
                        <h1>Pagar</h1>
                        <p>Realiza el pago de tus prestamos desde Financeflex en cuestión de clicks.</p>
                    </div>
                </div>
            </section>
        </section>
    </div>

    
     <footer>
        <div class="footer-content">
            <h3>FinanceFlex</h3>
            <p>Tu mejor alternativa para administrar tus ahorros y conseguir tus metas fácil y rápido.</p>
            <ul class="social">
                <li><a href=""><i class="fa-solid fa-at"></i></a></li>
                <li><a href=""><i class="fa-brands fa-twitter"></i></a>
                <li><a href=""><i class="fa-brands fa-github"></i></a>
            </ul>
            <div class="footer-bottom">
                <p>Todos los derechos reservados FinanceFlex ®2010, Prohibida su reproducción total o parcial sin autorización.</p>
            </div>
        </div>
     </footer>

     
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="public/js/jquery-3.6.1.min.js"></script>
<script src="public/js/alertas.js"></script>
    <script>
        var menuList = document.getElementById("menuList");
        menuList.style.maxHeight = "0px";

        function togglemenu(){
            if(menuList.style.maxHeight == "0px"){
                menuList.style.maxHeight = "130px";
            }
            else{
                menuList.style.maxHeight = "0px";  
            }
        }
    </script>
</body>
</html>

 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>/public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>/public/css/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="cont">
        <div class="navbar">
            <img src="<?php echo constant('URL'); ?>/public/img/logo_transparent-white.png" class="logo">
            <nav>
                <ul id="menuList">
                    <li><a href="<?php echo constant('URL'); ?>">INICIO</a></li>
                    <li><a href="#">NOSOTROS</a></li>
                    <li><a href="">ACERCA DE</a></li>
                </ul>
            </nav>
            <img src="<?php echo constant('URL'); ?>/public/img/menu.png" class="menu" onClick="togglemenu()">
        </div>
        <div class="row">
            <div class="col-1">
                <h2>COMIENZA</h2>
                <h3>A ADMINISTRAR TU DINERO</h3>
                <p>con FinanceFlex</p>
                <button type="button"><a href="<?php echo constant('URL'); ?>signup.php">Empieza Ya</button></a>
            </div>
            <div class="col-2">
                <img src="<?php echo constant('URL'); ?>/public/img/Character 1.png" class="person">
                <div class="color-box"></div>
            </div>
        </div>
    </div>
    <script>
        var menuList = document.getElementById("menuList");
        menuList.style.maxHeight = "0px";

        function togglemenu(){
            if(menuList.style.maxHeight == "0px"){
                menuList.style.maxHeight = "130px";
            }
            else 
                {
                  menuList.style.maxHeight = "0px";  
                }
        }
    </script>
    <div class="container-n">
        <section class="nosotros">
            <h1> FinanceFlex </h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores hic dicta facilis maiores alias corporis reiciendis, consequuntur facere suscipit omnis.</p>
            <h2>Contamos con:</h2>
        
            <section class="hacer">
                <div class="bloque">
                    <div class="item">
                        <img class="bloque__imagen" src="<?php echo constant('URL'); ?>/public/img/money.png" alt="">
                        <h1> Administación</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="col-1-item">
                    <div class="item">
                        <img class="bloque__imagen" src="<?php echo constant('URL'); ?>/public/img/deposit.png" alt="">
                        <h1> Depositos</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="col-1-item">
                    <div class="item">
                        <img class="bloque__imagen" src="<?php echo constant('URL'); ?>/public/img/fees.png" alt="">
                        <h1> Transacciones</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="col-1-item">
                    <div class="item">
                        <img class="bloque__imagen" src="<?php echo constant('URL'); ?>/public/img/growth.png" alt="">
                        <h1> Prestamos</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </section>
        </section>
    </div>

    
     <footer>
        <div class="footer-content">
            <h3>FinanceFlex</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio quam molestias fugit nesciunt explicabo nisi.</p>
            <ul class="social">
                <li><a href=""><i class="fa-solid fa-at"></i></a></li>
                <li><a href=""><i class="fa-brands fa-twitter"></i></a>
                <li><a href=""><i class="fa-brands fa-github"></i></a>
            </ul>
            <div class="footer-bottom">
                <p>Copyright &copy;2022 FinanceFlex.</p>
            </div>
        </div>
     </footer>
</body>
</html>
<?php
include 'error-log.php';
session_start();
if(isset($_SESSION["id_ejecutivo"])){
    require_once './includes/db.php';
    header('Location: ./ejecutivo/index.php');
}else{
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FiannceFlex</title>
    <link rel="shortcut icon" href="./public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./public/css/estilos.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="singin-singup">
                <form id="loginclient" class="sign-in-form">
                    <h2 class="title">Inicia Sesión</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" id="email" placeholder="Usuario" autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Contraseña" autocomplete="off">
                    </div>
                    <input type="submit" value="Iniciar Sesión" class="btn solid">
                </form>
                <form id="loginadmin" class="sign-up-form">
                <h2 class="title">ADMINISTRADOR</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="emailAdmin" id="emailAdmin" placeholder="Usuario" autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="passwordAdmin" id="passwordAdmin" placeholder="Contraseña" autocomplete="off">
                    </div>
                    <div id="InfoBanner" style="">

                    </div>
                    <input type="submit" name="ini-admin" id="ini-admin" value="Iniciar Sesión" class="btn solid">
                </form>
            </div>
        </div>
        <div class="contenedor-loader">
            <div class="ids-roller">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Nuevo por aquí?</h3>
                    <p>Para poder registrate en FinanceFlex es necesario acudir con uno de nuestros ejecutivos.</p>
                    <button class="btn transparent" id="sign-up-btn">Soy ejecutivo</button>
                </div>
                <img src="./public/img/Character_2.png" class="image" alt="Imagen de ladaz3d en Freepik">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Bienvenido</h3>
                    <p>Ya te encuentras registrado en Finance Flex?</p>
                    <button class="btn transparent" id="sign-in-btn">Inicia sesión</button>
                </div>
                <img src="./public/img/mobile_pay.svg" class="image" alt="">
            </div>
        </div>
    </div>

    <script src="./public/js/app.js"></script>
</body>
</html>
<?php
}
?>
<?php
//include 'error-log.php';
session_start();
if(isset($_SESSION['id_ejecutivo'])){
    require_once './includes/db.php';
    header('Location: ./ejecutivo/index.php');
}
else if(isset($_SESSION['id_cliente'])){
    require_once './includes/db.php';
    header('Location: ./usuario/index.php');
}
else{
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FianceFlex</title>
    <link rel="shortcut icon" href="./public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./public/css/estilos.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="singin-singup" id="sing-in">
                <form id="loginclient" class="sign-in-form">
                    <h2 class="title">Inicia Sesión</h2>
                    <p class="formulario-input-error" id="formulario-input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
                    <p class="formulario-mensaje" id="formulario-mensaje"><b>Error:</b> Por favor rellena el formulario correctamente. </p>
                    <div class="input-field-email" id="input-email">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" id="email" placeholder="Correo" autocomplete="off" required>
                    </div>
                    <div class="input-field-password" id="input-password">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Contraseña" autocomplete="off" required>
                    </div>
                    <div id="InfoBannerClient" style="">
                        
                    </div>
                    <input type="submit" value="Iniciar Sesión" class="btn solid">
                </form>
                <form id="loginadmin" class="sign-up-form">
                <h2 class="title">ADMINISTRADOR</h2>
                    <div class="input-field-email">
                        <i class="fas fa-user"></i>
                        <input type="email" name="emailAdmin" id="emailAdmin" placeholder="Correo" autocomplete="off" required>
                    </div>
                    <div class="input-field-password">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="passwordAdmin" id="passwordAdmin" placeholder="Contraseña" autocomplete="off" required>
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
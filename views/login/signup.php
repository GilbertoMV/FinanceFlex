<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php $this->showMessages();?>
    
    <form action="<?php echo constant('URL'); ?>/signup/newUser" method="post">
        <h2>Registrarse</h2>
        <p>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </p>
        <p>
            <label for="password">Password</label>
            <input type="text" name="password" id="password">
        </p>
        <p>
            <input type="submit" value="Iniciar sesion" />
        </p>
        <p>
            Tienes una cuenta? <a href="<?php echo constant('URL'); ?>">Iniciar sesion</a>
        </p>
    </form>
</body>
</html>
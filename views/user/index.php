<?php
$user = $this->d['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
    <?php if($user->getPhoto() != ''){ ?>
        <img src="public/img/photos<?php echo $user->getPhoto(); ?>" width="200" /> 
    <?php } 
    ?>
    <h2><?php echo ($user->getEmail() != '')? $user->getEmail(): $user->getEmail(); ?></h2>    
    <form action=<?php echo constant('URL'). 'user/updateEmail' ?> method="POST">
        <div class="section">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" autocomplete="off" required value="<?php echo $user->getEmail() ?>">
            <div><input type="submit" value="Cambiar nombre" /></div>
        </div>
    </form>

    <form action=<?php echo constant('URL'). 'user/updatePhoto' ?> method="POST" enctype="multipart/form-data">
        <div class="section">
            <label for="photo">Foto de perfil</label>
            <?php
            //validar si usuario tiene foto
                if(!empty($user->getPhoto())){
            ?>
                <img src="<?php echo constant('URL')  ?>public/img/photos<?php echo $user->getPhoto(); ?>"
            <?php
                }
            ?>
            <input type="file" name="photo" id="photo" autocomplete="off" required>
            <div><input type="submit" value="Cambiar foto de perfil" /></div>
        </div>
    </form>

    <section id="password-user-container">
        <form action="<?php echo constant('URL'). 'user/updatePassword' ?>" method="post">
            <div class="section">
                <label for="current-password">Password actual</label>
                <input type="password" name="current-password" id="current-password" autocomplete="off" required>

                <label for="new-password">Nuevo password</label>
                <input type="password" name="new-password" id="new-password" autocomplete="off" required>
                <div><input type="submit" value="Cambiar password" /></div>
            </div>
        </form>
    </section>

    <section id="udget-user-container">
        <form action="<?php echo constant('URL'). 'user/updateBudget' ?>"method="POST">
            <div class="section">
                <label for="current-password">Definir presupuesto</label>
                <div><input type="number" name="budget" id="budget" autocomplete="off" required value="<?php echo $user->getBudget() ?>"></div>
                <div><input type="submit" value="Actualizar presupuesto" /></div>
            </div>
        </form>
    </section>
</body>
</html>
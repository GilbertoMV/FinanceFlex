<nav>
    <div class="nav__container">
        <a href="index.php" class="home"><img class="logo" src="../public/img/logito.png" alt="home"> FinanceFlex</a>           
        <label for="menu" class="nav__label">
            <img src="../public/img/menu.svg" alt="menuicon" class="nav__img">
        </label>
        <input type="checkbox" id="menu" class="nav__input">

        <div class="nav__menu">
            <a href="index.php" class="a">Mi Apartado</a>
            <a href="prestamos.php" class="a">Prestamos</a>
            <a href="perfil.php" class="a config">Configuración</a>
            <a href="ayuda.php" class="a">Ayuda</a>
            <a href="../controllers/logoutcontroller.php" class="a logout"><i class="bi bi-door-closed"></i> Cerrar Sesion </a>
            
            
            
            <ul class="ul a">
                <li><a href="#"><img src="../public/img/stockProfile.png" alt=""  class="profilePhoto"> <?= $_SESSION['nom']?><i class="bi bi-caret-down"></i></a>
                    <ul>
                        <li><a href="configuracion.php" class="a"><i class="bi bi-sliders"></i> Configuración</a></li>
                        <li><a href="../controllers/logoutcontroller.php" class="a"><i class="bi bi-door-closed"></i> Cerrar Sesion </a></li>
                    </ul>
                </li>
            </ul>



            
        </div>
    </div>
</nav>
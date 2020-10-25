<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="http://codd.ing.puc.cl/~grupo81/index.php">
        <figure class="image is-48x48">
            <img src="https://img2.freepng.es/20181206/oxv/kisspng-wind-wave-image-portable-network-graphics-illustra-5c093f8c0a5362.4396725915441099640423.jpg">
        </figure>
        </a>
    </div>
    <div class="navbar-brand">
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="http://codd.ing.puc.cl/~grupo81/crear_cuenta.php">
                    Crear Cuenta
                </a>
                <a class="navbar-item" href="http://codd.ing.puc.cl/~grupo81/login.php">
                    Iniciar Sesion
                </a>
                <a class="navbar-item" href="http://codd.ing.puc.cl/~grupo81/consultas/perfil.php">
                    <?php
                        session_start();
                        if ($_SESSION['name'] == "") {
                            echo "Perfil";
                        } else {
                            echo "Perfil";
                        }
                        ?>
                    <?php  ?>
                </a>
                <a class="navbar-item" href="http://codd.ing.puc.cl/~grupo81/consultas/load_accounts.php">
                    Cargar Cuentas Capitanes/Jefes
                </a>
            </div>
        </div>
    </div>
</nav>

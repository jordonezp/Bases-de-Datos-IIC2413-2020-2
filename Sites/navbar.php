<?php
    session_start();

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" >
            <img src="https://c0.klipartz.com/pngpicture/459/215/gratis-png-base-de-datos-de-iconos-de-computadora-del-almacen-de-datos-extraer-transformar-cargar-icono-de-datos.png" width="70" height="120">
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
                        if ($name == "") {
                        } else {
                            echo "$name";
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

<?php
    session_start();
    $name = $_SESSION["name"];

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" >
            <img src="https://w7.pngwing.com/pngs/13/363/png-transparent-computer-icons-database-table-sql-others-blue-data-big-data.png" width="70" height="120">
        </a>
    </div>
    <div class="navbar-brand">
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="http://codd.ing.puc.cl/~grupo94/crear_cuenta.php">
                    Crear Cuenta
                </a>
                <a class="navbar-item" href="http://codd.ing.puc.cl/~grupo94/login.php">
                    Iniciar Sesion
                </a>
                <a class="navbar-item" href="http://codd.ing.puc.cl/~grupo94/perfil.php">
                    <?php
                        session_start();
                        if ($name == "") {
                        } else {
                            echo "$name";
                        }
                        ?>
                   <?php  ?>
                </a>

            </div>
        </div>
    </div>
</nav>

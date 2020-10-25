<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>
<?php include('../templates/header.html');   ?>




<div class="container is-max-desktop">
        <head>
          <h1 class="title"> Cambio de contraseña </h1>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
        </head>
        <h2 class="subtitle"> Ingresa tu contraseña antigua</h2>
            <form align="center" action="consultas/consulta_buque_naviera.php" method="post">
                Nombre Naviera:
                <input class="input is-rounded" style="width: 33%;" type="text" name="nombre_naviera">
                <br/><br/>
                <input class="button is-link" type="submit" value="Buscar">
            </form>
  </div>
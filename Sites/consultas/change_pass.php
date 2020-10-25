<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>
<?php include('../templates/header.html');   ?>

<br/><br/><br/>
<?php $pas = $_POST["pas"]; ?>
<div class="container is-max-desktop">
        <head>
          <h1 class="title"> Cambio de contraseña </h1>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
        </head>
        <h2 class="subtitle"> Ingresa tu antigua y nueva contraseña, la nueva contraseña debe ser de largo 6, solo puedes usar letras y numeros</h2>
            <form align="center" action="change_pass2.php" method="post">
                Contraseña Antigua:
                <input class="input is-rounded" style="width: 33%;" type="text" name="old">
                <br/><br/>
                Contraseña Nueva:
                <input class="input is-rounded" style="width: 33%;" type="text" name="new">
                <input type = "hidden" name = "rut" value = '$pas' />
                <br/><br/>
                <input class="button is-link" type="submit" value="Cambiar">
            </form>
  </div>
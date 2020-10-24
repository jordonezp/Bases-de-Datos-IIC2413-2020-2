<?php include('navbar.php'); ?>
<?php include('templates/header.html');   ?>


<br>
  <br>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">


  <br/>
  <div class="container is-max-desktop">
  <h1 class="title">Creador de cuenta</h1>
  <p class="subtitle">Ingresa tu informacion.</p>
        <form align="center" action="consultas/crear_cuenta.php" method="post">
            Pasaporte:
            <input class="input is-rounded" style="width: 33%;" type="text" name="pasaporte">
            <br><br> <br>
            Contraseña:
            <input class="input is-rounded" style="width: 33%;" type="text" name="pass">
            <br><br> <br>
            Nombre:
            <input class="input is-rounded" style="width: 33%;" type="text" name="nombre">
            <br><br> <br>
            Edad:
            <input class="input is-rounded" style="width: 33%;" type="text" name="edad">
            <br><br> <br>
            Sexo:
            <input class="input is-rounded" style="width: 33%;" type="text" name="sexo">
            <br><br> <br>
            Nacionalidad:
            <input class="input is-rounded" style="width: 33%;" type="text" name="nacio">
            <br/><br/>
            <input class="button is-link" type="submit" value="Buscar">
        </form>
  </div>
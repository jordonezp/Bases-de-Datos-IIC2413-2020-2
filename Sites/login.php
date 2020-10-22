<?php session_start(); ?>

<?php include('templates/header.html');   ?>
<?php include('navbar.php'); ?>
<br>
  <br>

<head>
  <title> Ingrese a su cuenta </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
</head>


<body>
  <h1 class="title">Ingresa a tu cuenta</h1>

  <br/>
  <div class="container is-max-desktop">
    <h2 class="title"> Login </h2>
        <form align="center" action="consultas/perfil.php" method="post">
            Pasaporte:
            <input class="input is-rounded" style="width: 33%;" type="text" name="pasaporte">
            <br/><br/>
            Contraseña:
            <input class="input is-rounded" style="width: 33%;" type="text" name="clave">
            <br/><br/>
            <input class="button is-link" type="submit" value="Ingresar">
        </form>
  </div>
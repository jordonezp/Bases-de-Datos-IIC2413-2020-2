<?php include('templates/header.html');   ?>

<?php include('navbar.php'); ?>
<br>
  <br>

<head>
  <title> Creacion de Cuenta </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
</head>

<body>
  <h1 class="title">Biblioteca Buques de Guerra que hacen de todo menos pelear</h1>
  <p class="subtitle">Aquí podrás encontrar información sobre los buques, navieras entre otros.</p>


  <br/>
  <div class="container is-max-desktop">
    <h2 class="title"> Crea tu cuenta !!!  </h2>
        <form align="center" action="consultas/crear_cuenta.php" method="post">
            pasaporte:
            <input class="input is-rounded" style="width: 33%;" type="text" name="pasaporte">
            <br><br> <br>
            contraseña:
            <input class="input is-rounded" style="width: 33%;" type="text" name="pass">
            <br><br> <br>
            nombre:
            <input class="input is-rounded" style="width: 33%;" type="text" name="nombre">
            <br><br> <br>
            edad:
            <input class="input is-rounded" style="width: 33%;" type="text" name="edad">
            <br><br> <br>
            sexo:
            <input class="input is-rounded" style="width: 33%;" type="text" name="sexo">
            <br><br> <br>
            nacionalidad:
            <input class="input is-rounded" style="width: 33%;" type="text" name="nacio">
            <br/><br/>
            <input class="button is-link" type="submit" value="Buscar">
        </form>
  </div>
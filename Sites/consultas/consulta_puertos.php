<?php session_start();?>
<?php include('../templates/header.html');   ?>
<?php include('../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../config/conection.php');

$pid = $_GET["pid"];
$name = $_GET["name"];

?>
<br/><br/><br/>

<div class="container is-max-desktop">
    <h1 class="title"> Puerto <?php echo $name ?></h1>

    <h2>Consulte la ocupación de las instalaciones por fecha</h2>

    <form action="" method="post">
        Muestre todos los días en que todas las instalaciones del puerto <?php echo $name ?>
        estuvieron libres desde el día  <input type="" name="fecha_inicio">, hasta el día
        <input type="" name="fecha_termino"> <br>
        <input class="button is-link" type="submit" value="Consultar">
    </form>
</div>
<br/><br/><br/>
<div class="container is-max-desktop">
    <h2 class="subtitle">Generar permiso</h2>

    <h3 class="subtitle"> Muelle </h3>

    <form action="respuesta_permiso.php" method="post">
        Revise si es que el buque de patente <input type="" name="patente_barco"> puede atracar en algun muelle del puerto <?php echo $name ?>
        el día  <input type="" name="fecha_atraco">. <b>NOTA</b>: De poderse, se generará el permiso para el buque en la fecha indicada.
        <input type="hidden" name="tipo"  value="port"> <input type="hidden" name="nombre_puerto"  value= "<?php echo $name; ?>">
        <input type="hidden" name="pid"  value= "<?php echo $pid; ?>">  <br>
        <input class="button is-link" type="submit" value="Consultar">
     </form>
</div>
<br/><br/><br/>
<div class="container is-max-desktop">
    <h3 class="subtitle"> Astillero </h3>

    <form action="respuesta_permiso.php" method="post">
        Revise si es que el buque de patente <input type="" name="patente_barco"> puede atracar en algun astillero del puerto <?php echo $name ?>
       desde el día  <input type="" name="fecha_atraco"> hasta el día <input type="" name="fecha_salida">. <b>NOTA</b>: De poderse, se generará el permiso para el buque en la fecha indicada.
       <input type="hidden" name="tipo"  value="shipyard"> <input type="hidden" name="nombre_puerto"  value= "<?php echo $name; ?>" >
       <input type="hidden" name="pid"  value= "<?php echo $pid; ?>"> <br>
       <input class="button is-link" type="submit" value="Consultar">
    </form>
</div>

<br/><br/><br/>
<div class="container is-max-desktop">
<form action="../puertos.php" method="get">
    <input class="button is-link" type="submit" value="Volver">
</form>
</div>
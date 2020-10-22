<?php

require('../config/conection.php');

$pid = $_GET["pid"];
$name = $_GET["name"];

?>

<h1> Puerto <?php echo $name ?></h1>

<h2>Consulte la ocupación de las instalaciones por fecha</h2>

<form action="" method="post">
    Muestre todos los días en que todas las instalaciones del puerto <?php echo $name ?>
    estuvieron libres desde el día  <input type="" name="fecha_inicio">, hasta el día
     <input type="" name="fecha_termino"> <br>
    <input type="submit" value="Consultar">
</form>


<h2>Generar permiso</h2>

<h3> Muelle </h3>

<form action="respuesta_permiso.php" method="post">
    Revise si es que el buque de patente <input type="" name="patente_barco"> puede atracar en algun muelle del puerto <?php echo $name ?>
    el día  <input type="" name="fecha_atraco">. <b>NOTA</b>: De poderse, se generará el permiso para el buque en la fecha indicada.
    <input type="hidden" name="tipo"  value="port"> <input type="hidden" name="nombre_puerto"  value= <?php $name ?>> 
    <input type="hidden" name="pid"  value= <?php $pid ?>>  <br>
    <input type="submit" value="Consultar">
 </form>

<h3> Astillero </h3>

<form action="respuesta_permiso.php" method="post">  
    Revise si es que el buque de patente <input type="" name="patente_barco"> puede atracar en algun astillero del puerto <?php echo $name ?>
   desde el día  <input type="" name="fecha_atraco"> hasta el día <input type="" name="fecha_salida">. <b>NOTA</b>: De poderse, se generará el permiso para el buque en la fecha indicada.
   <input type="hidden" name="tipo"  value="shipyard"> <input type="hidden" name="nombre_puerto"  value= <?php $name ?> > 
   <input type="hidden" name="pid"  value= <?php $pid ?> > <br>
   <input type="submit" value="Consultar">
</form>

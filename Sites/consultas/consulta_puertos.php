<?php

require('../config/conection.php');

$pid = $_GET["pid"];
$name = $_GET["name"];

?>

<h1> Puerto <?php echo $name ?></h1>

<h2>Consulte la ocupación de las instalaciones por fecha</h2>

<form action="" method="post">
    Muestre todos los días en que todas las instalaciones del puerto <?php echo $name ?>
    estuvieron libres desde el día (escribir en formato dd) <input type="number" name="dia_inicio">
    del mes (escribir en formato mm) <input type="number" name="mes_inicio"> del año (escribir en
    formato yyyy) <input type="number" name="año_inicio">, hasta el día (escribir en formato dd)
    <input type="number" name="dia_termino"> del mes (escribir en formato mm) <input
        type="number" name="mes_termino"> del año (escribir en formato yyyy) <input type="number"
                                                                                    name="año_termino"> <br>
    <input type="submit" value="Buscar">
</form>

<h2>Generar permiso</h2>

    <form action="" method="post">
        Muestre todas las veces en que el barco de nombre <input type="text" name="input_4_1"> ha
        atracado en la ciudad de nombre <input type="text" name="input_4_2">. <br>
        <input type="submit" value="Buscar">
    </form>


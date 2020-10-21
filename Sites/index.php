<?php
    require('./config/conection.php');

    $query = "SELECT * FROM facilities;";
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $facilities = $result -> fetchAll();
?>


<h1>Biblioteca Puertos, Astilleros y Gerencia</h1>
    <br>
<h3>Las siguientes consultas son válidas</h3>
    <br>
    <br>
<form action="consultas/consulta_1.php" method="get">
    Muestre todos los puertos junto la ciudad a la que son asignados. <br>
    <input type="submit" value="Buscar">
</form>
    <br>
    <br>
<form action="consultas/consulta_2.php" method="post">
    Muestre todos los jefes de las instalaciones del puerto con nombre <input type="text"
                                                                              name="input_2">. <br>
    <input type="submit" value="Buscar">
</form>
    <br>
    <br>
<form action="consultas/consulta_3.php" method="get">
    Muestre todos los puertos que tienen al menos un astillero. <br>
    <input type="submit" value="Buscar">
</form>
    <br>
    <br>
<form action="consultas/consulta_4.php" method="post">
    Muestre todas las veces en que el barco de nombre <input type="text" name="input_4_1"> ha
    atracado en la ciudad de nombre <input type="text" name="input_4_2">. <br>
    <input type="submit" value="Buscar">
</form>
    <br>
    <br>
<form action="consultas/consulta_5.php" method="get">
    Muestre la edad promedio de los trabajadores de cada puerto.<br>
    <input type="submit" value="Buscar">
</form>
    <br>
    <br>
<form action="consultas/consulta_6.php" method="post">
    Muestre el puerto que ha recibido más barcos en el mes (escribir en formato mm) <input
            type="number" name="input_6_1"> del año (escribir en formato yyyy) <input type="number"
                                                                                    name="input_6_2">. <br>
    <input type="submit" value="Buscar">
</form>
    <br>
    <br>

</form>
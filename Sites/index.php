<?php
    require('./config/conection.php');

    $query = "SELECT * FROM facilities;";
    $result = $db -> prepare($query);
    $result -> execute();
    $facilities = $result -> fetchAll();
?>

<!--todo: Actualizar los nombres de la atributos en el esquema y diagrama-->
<!--todo: Verificar que el procesamiento de datos esté bien-->
<!--todo: Verificar resultados de consultas 4, 5 y 6-->
<!--todo: Discutir que no haya dependencia funcional relación FacilityHistoryEntries-->
<!--todo: -->
<!--todo: -->

<!---->
<!---->
<!---->
<!---->

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
            type="text" name="input_6_1"> del año (escribir en formato yyyy) <input type="text"
                                                                                    name="input_6_2">. <br>
    <input type="submit" value="Buscar">
</form>

<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!---->

    <h1>Hello World!!!</h1>
<br><br>
<form action="consultas/consultas_generales.php" method="post">
    Input: 
    <input type="text" name="input">
    <br>
    <input type="submit" name="submit" value="Submit"> 
</form>
<br>
<br>
<table>
    <tr>
        <th>fid</th>
        <th>type</th>
        <th>capacity</th>
        <th>boss_rut</th>
        <th>pid</th>
    </tr>
<?php
    foreach ($facilities as $f) {
        echo 
        "<tr>
            <td>$f[0]</td>
            <td>$f[1]</td>
            <td>$f[2]</td>
            <td>$f[3]</td>
            <td>$f[4]</td>
        </tr>"
        ;
    }
?>
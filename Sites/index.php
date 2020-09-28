<?php
    require('./config/conection.php');

    $query = "SELECT * FROM facilities;";
    $result = $db -> prepare($query);
    $result -> execute();
    $facilities = $result -> fetchAll();
?>

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
    Muestre todos los puertos junto la ciudad a la que son asignados.
    <input type="submit" value="Buscar">
</form>

    <br>
    <br>

<form action="consultas/consulta_2.php" method="post">
    Muestre todos los jefes de las instalaciones del puerto con nombre <input type="text" name="input_2">.
    <input type="submit" value="Buscar">
</form>

    <br>
    <br>

<form action="consultas/consulta_3.php" method="get">
    Muestre todos los puertos que tienen al menos un astillero.
    <input type="submit" value="Buscar">
</form>

    <br>
    <br>

<form action="consultas/consulta_4.php" method="post">
    Muestre todas las veces en que el barco <input type="text" name="input_4_1"> ha atracado en
    <input type="text" name="input_4_2">.
    <input type="submit" value="Buscar">
</form>

    <br>
    <br>

<form action="consultas/consulta_5.php" method="get">
    Muestre la edad promedio de los trabajadores de cada puerto.
    <input type="submit" value="Buscar">
</form>

    <br>
    <br>

<form >
    Muestre el puerto que ha recibido más barcos en <input type="text" name="input_6_1"> del
    <input type="text" name="input_6_2">.
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
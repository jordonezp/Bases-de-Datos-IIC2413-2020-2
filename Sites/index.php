<?php
    require('./config/conection.php');

    $query = "SELECT * FROM facilities;";
    $result = $db -> prepare($query);
    $result -> execute();
    $facilities = $result -> fetchAll();
?>

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
<?php
    require('./config/conection.php');

    $input = $_POST["input"];
    $query = "SELECT * FROM facilities;";
    $result = $db -> prepare($query);
    $result -> execute();
    $facilities = $result -> fetchAll();
?>

<h1>Consultas Generales</h1>
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
        echo "<tr>";
        foreach ($f as $f_i)
            echo "<td>$f_i</td>"
        echo "</tr>";
    }
?>
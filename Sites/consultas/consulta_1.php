<?php
require('../config/conection.php');

$query = "SELECT name, cid FROM ports;";
$result = $db -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>

<h1>Resultado</h1>

<table>
    <tr>
        <th>name</th>
        <th>cid</th>
    </tr>

<?php
foreach ($tabla as $fila) {
    echo "<tb>";
    foreach ($fila as $entrada){
        echo "<td>$entrada[0]</td><td>$entrada[1]</td>";
    }
    echo "</tb>";
}
?>
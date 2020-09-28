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
        <th>cid</th>
        <th>name</th>
    </tr>

<?php
foreach ($tabla as $fila) {
    echo "<tr><td>$fila[1]</td><td>$fila[0]</td></tr>";
}
?>
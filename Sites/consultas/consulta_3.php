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
            <th>pid</th>
        </tr>

<?php
foreach ($tabla as $fila) {
    foreach ($fila as $entrada){
        echo "<tr><td>$entrada[0]</td></tr>";
    }
}
?>
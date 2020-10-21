<?php
require('../config/conection.php');

$query = "SELECT * FROM naviera;";
$result = $dbp -> prepare($query);
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
        echo "<tr><td>$fila[0]</td><td>$fila[1]</td></tr>";
    }
    ?>
</table>

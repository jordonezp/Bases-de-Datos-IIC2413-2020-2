<?php
require('../config/conection.php');

$input_2 = strtoupper($_POST["input_2"]);

$query = "SELECT facilities.boss_rut FROM (SELECT pid FROM ports WHERE UPPER(name) LIKE '%$input_2%') AS puertos, facilities WHERE puertos.pid = facilities.pid;";
$result = $dbimp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>

<h1>Resultado</h1>

<table>
    <tr>
        <th>boss_rut</th>
    </tr>

    <?php
    foreach ($tabla as $fila) {
        echo "<tr><td>$fila[0]</td></tr>";
    }
    ?>

</table>
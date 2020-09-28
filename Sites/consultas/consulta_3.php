<?php
require('../config/conection.php');

$query = " SELECT DISTINCT pid FROM facilities WHERE UPPER(type) LIKE '%SHIPYARD%';";
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
    echo "<tr><td>$fila[0]</td></tr>";
}
?>
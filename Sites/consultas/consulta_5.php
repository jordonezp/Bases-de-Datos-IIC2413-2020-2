<?php
require('../config/conection.php');

$query = "SELECT puertos.pid, AVG(employees.age) FROM (SELECT ports.pid, facilities.fid FROM ports, facilities WHERE ports.pid = facilities.pid) AS puertos, employees WHERE puertos.fid = employees.fid GROUP BY puertos.pid;";
$result = $db -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>

<h1>Resultado</h1>

<table>
    <tr>
        <th>pid</th>
        <th>promedio_edad</th>
    </tr>

<?php
foreach ($tabla as $fila) {
    echo "<tr><td>$fila[0]</td><td>$fila[1]</td></tr>";
}
?>

</table>

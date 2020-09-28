<?php
require('../config/conection.php');

$query = "SELECT puertos.pid, AVG(employees.age) FROM (SELECT ports.pid, facilities.fid FROM ports, facilities) AS puertos, employees GROUP BY puertos.pid;";
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
    foreach ($fila as $entrada){
        echo "<tr><td>$entrada[0]</td><td>$entrada[1]</td></tr>";
    }
}
?>
<?php
require('../config/conection.php');

$input_4_1 = strtoupper($_POST["input_4_1"]);
$input_4_2 = strtoupper($_POST["input_4_2"]);

//
//
// Falta completar consulta
$query = "SELECT atraques.arrival_date FROM (SELECT facilities.fid FROM (SELECT ports.pid FROM cities, ports WHERE UPPER(cities.name) LIKE '%$input_4_2%' AND cities.cid = ports.cid) AS puertos, facilities WHERE puertos.pid = facilities.pid) AS instalaciones, (SELECT arrival_date, fid FROM shipyard_permits, ships WHERE UPPER(ships.name) LIKE '%$input_4_1%' UNION SELECT arrival_date, fid FROM dock_permits, ships WHERE UPPER(ships.name) LIKE '%$input_4_2%') AS atraques WHERE atraques.fid = instalaciones.fid;";
$result = $dbimp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>

<h1>Resultado</h1>

<table>
    <tr>
        <th>arrival_date</th>
    </tr>

<?php
foreach ($tabla as $fila) {
    echo "<tr><td>$fila[0]</td></tr>";
}
?>

</table>

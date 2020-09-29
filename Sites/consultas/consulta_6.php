<?php
require('../config/conection.php');

$_POST["input_6_1"];
$_POST["input_6_2"];

$min = date_create($_POST["input_6_2"]."-".$_POST["input_6_1"]."-"."01");
$fechamin = date_format($min, 'Y-m-d');
$max = date_create($_POST["input_6_2"]."-".(string)((int)$_POST["input_6_1"] + 1)."-"."01");
$fechamax = date_format($max, 'Y-m-d');

$query = "SELECT pid FROM (SELECT COUNT(*), pid FROM (SELECT f.pid, t.license_plate FROM facilities as f, ((SELECT license_plate, fid FROM dock_permits WHERE arrival_date >= $fechamin AND arrival_date < $fechamax) UNION (SELECT license_plate, fid FROM shipyard_permits WHERE arrival_date >= $fechamin AND arrival_date < $fechamin)) as t WHERE f.fid=t.fid) AS t1 GROUP BY pid) as t4, (SELECT MAX(count) FROM (SELECT COUNT(*), pid FROM (SELECT f.pid, t.license_plate FROM facilities as f, ((SELECT license_plate, fid FROM dock_permits WHERE arrival_date >= $fechamin AND arrival_date < $fechamax) UNION (SELECT license_plate, fid FROM shipyard_permits WHERE arrival_date >= $fechamin AND arrival_date < $fechamax)) as t WHERE f.fid=t.fid) AS t1 GROUP BY pid) AS t3) AS t5 WHERE t4.count=t5.max;";
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

</table>

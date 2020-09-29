<?php
require('../config/conection.php');

$_POST["input_6_1"];
$_POST["input_6_2"];

$min = mktime(0,0,0, $_POST["input_6_1"], 1, $_POST["input_6_2"]);
if ($_POST["input_6_1"] == 12) {
    $max = mktime(0,0,0, 1, 1, $_POST["input_6_2"] + 1);
}
else {
    $max = mktime(0,0,0, $_POST["input_6_1"] + 1, 1, $_POST["input_6_2"]);
}
$fechamin = date('Y-m-d', $min);
$fechamax = date('Y-m-d', $max);


$query = "SELECT pid FROM (SELECT COUNT(*), pid FROM (SELECT f.pid, t.license_plate FROM facilities as f, ((SELECT license_plate, fid FROM dock_permits WHERE arrival_date >= '$fechamin' AND arrival_date < '$fechamax') UNION (SELECT license_plate, fid FROM shipyard_permits WHERE arrival_date >= '$fechamin' AND arrival_date < '$fechamax')) as t WHERE f.fid=t.fid) AS t1 GROUP BY pid) as t4, (SELECT MAX(count) FROM (SELECT COUNT(*), pid FROM (SELECT f.pid, t.license_plate FROM facilities as f, ((SELECT license_plate, fid FROM dock_permits WHERE arrival_date >= '$fechamin' AND arrival_date < '$fechamax') UNION (SELECT license_plate, fid FROM shipyard_permits WHERE arrival_date >= '$fechamin' AND arrival_date < '$fechamax')) as t WHERE f.fid=t.fid) AS t1 GROUP BY pid) AS t3) AS t5 WHERE t4.count=t5.max;";
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

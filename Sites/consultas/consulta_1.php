<?php
require('../config/conection.php');

$query = "SELECT name, cid FROM ports;";
$result = $db -> prepare($query);
$result -> execute();
$facilities = $result -> fetchAll();
?>

<h1>Resultado</h1>

<table>
    <tr>
        <th>name</th>
        <th>cid</th>
    </tr>

<?php
foreach ($facilities as $f) {
    echo "<tr>";
    foreach ($f as $f_i){
        echo "<td>$f_i</td>";
    }
    echo "</tr>";
}
?>
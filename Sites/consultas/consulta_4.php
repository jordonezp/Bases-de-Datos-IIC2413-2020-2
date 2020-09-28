<?php
require('../config/conection.php');

$input_4_1 = strtoupper($_POST["input_4_1"]);
$input_4_2 = strtoupper($_POST["input_4_2"]);

//
//
// Falta completar consulta
$query = "";
$result = $db -> prepare($query);
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
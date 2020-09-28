<?php
require('../config/conection.php');

$union = "-";
$input_6_1 = $union.$_POST["input_6_1"];
$input_6_2 = $union.$_POST["input_6_2"].$union;


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
            <th>pid</th>
        </tr>

<?php
foreach ($tabla as $fila) {
    echo "<tr><td>$fila[0]</td></tr>";
}
?>
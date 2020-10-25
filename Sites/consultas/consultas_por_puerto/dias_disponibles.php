<?php session_start();?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php
require('./../../config/conection.php');

$pid = $_GET["pid"];
$fecha_inicio = $_GET["fecha_inicio"];
$fecha_termino = $_GET["fecha_termino"];

// $query = "SELECT * FROM ports;";
// echo $pid;
// echo $fecha_inicio;
// echo $fecha_termino;
$query = "SELECT * FROM  get_available_days_for_facility_for_port_for_day_range(
    '$pid', '$fecha_inicio', '$fecha_termino');";
$result = $dbimp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>
<?php include('./../../templates/header.html');   ?>
<?php include('./../../navbar.php'); ?>
<br/><br/><br/>

<?php

    echo "<h2> Días disponibles en rango:  </h2>";
    echo "
        <table class='table'>
            <thead>
                <tr>
                    <th>fid</th>
                    <th>fecha</th>
                </tr>
            </thead>
            <tbody>
    ";

    foreach ($tabla as $fila) {
        echo "<tr> <td> $fila[0] </td> <td> $fila[1] </td> </tr>";
    }

    echo "
            </tbody>
        </table>
    ";

?>

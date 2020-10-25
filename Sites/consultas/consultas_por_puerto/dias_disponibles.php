<?php session_start();?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php
require('./../../config/conection.php');

$pid = $_GET["pid"];
$date1 = $_GET["fecha_inicio"];
$date2 = $_GET["fecha_termino"];

// $query = "SELECT * FROM ports;";
$query = "SELECT get_available_days_for_facility_for_port_for_day_range(
    5, '2020-01-01', '2020-01-20');";
$result = $dbimp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>
<?php include('./../templates/header.html');   ?>
<?php include('./../navbar.php'); ?>
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
        echo "<tr> <td> $fila[0][0] </td> <td> $fila[0][1] </td> </tr>";
    }

    echo "
            </tbody>
        </table>
    ";

?>

<?php session_start();?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php
require('./../../config/conection.php');

$pid = $_GET["pid"];
$name = $_GET["name"];
$fecha = $_GET["fecha_atraco"];
$patente = $_GET["patente_barco"];

// $query = "SELECT * FROM ports;";
// echo $pid;
// echo $fecha_inicio;
// echo $fecha_termino;
$query = "SELECT search_dock_permit_availability(
    '$pid, '$fecha', '$patente');";
$result = $dbimp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>
<?php include('./../../templates/header.html');   ?>
<?php include('./../../navbar.php'); ?>
<br/><br/><br/>

<?php

    // echo "<h2> Días disponibles en rango:  </h2>";
    // echo "
    // <div class='container is-max-desktop'>
    //     <h2> Porcentajes de ocupacion en el puerto '$name' entre las fechas '$fecha_inicio' y '$fecha_termino' </h2>
    //     <table class='table'>
    //         <thead>
    //             <tr>
    //                 <th>fid</th>
    //                 <th>ocupacion (%)</th>
    //             </tr>
    //         </thead>
    //         <tbody>
    // ";

    // foreach ($tabla as $fila) {
    //     echo "<tr> <td> $fila[0] </td> <td> $fila[1] % </td> </tr>";
    // }

    // echo "
    //         </tbody>
    //     </table>
    // </div>
    // ";
    echo "
    <div class='container is-max-desktop'>
        <h2> Consulta de muelles disponibles en el puerto $name para la fecha $fecha. </h2>
    ";
    foreach ($tabla as $fila) {
        echo "<h3> El resultado es: $result </h3>";
    }
    echo "</div>";

?>

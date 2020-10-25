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
// $query = "SELECT * FROM search_dock_permit_availability(
//     '$pid, '$fecha', '$patente');";
$query = "SELECT * FROM search_dock_permit_availability(
    $pid, $fecha, $patente);";
$result = $dbimp -> prepare($query);
$result -> execute();
$table = $result -> fetchAll();
?>
<?php include('./../../templates/header.html');   ?>
<?php include('./../../navbar.php'); ?>
<br/><br/><br/>

<?php

    echo "
    <div class='container is-max-desktop'>
        <h2> Consulta de muelles disponibles en el puerto $name para la fecha $fecha. </h2>
    ";
    echo "<h3> El resultado es: $table </h3>";
    echo count($table);
    foreach ($table as $fila) {
        echo "<h3> El resultado es: $fila[0] </h3>";
    }
    echo "</div>";

?>

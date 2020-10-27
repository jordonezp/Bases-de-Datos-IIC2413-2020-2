<?php session_start();?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php
require('./../../config/conection.php');

$pid = $_GET["pid"];
$name = $_GET["name"];
$fecha = $_GET["fecha_atraco"];
$patente = $_GET["patente_barco"];

$query = "SELECT * FROM search_dock_permit_availability(
    '$pid', '$fecha', '$patente');";
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
    
    $fid_disp = $table[0][0];
    if ($fid_disp < 0) {
        echo "<br>";
        echo "<h3> <b> No hay instalación disponible. </b> </h3>";
    } else {
        echo "<br>";
        echo "<h3> <b> Se ha encontrado instalación! </b> </h3>";
        echo "<h3> <b> La instalación disponible es: $fid_disp </b> </h3>";
    }
    echo "</div>";

?>

<?php

require('../config/conection.php');

$tipo = $_POST["tipo"];
$patente = $_POST["patente_barco"];
$fecha_atraco = $_POST["fecha_atraco"];
$nombre_puerto = $_POST["nombre_puerto"];
$pid = $_POST["pid"];

$query = "SELECT ;";
$result = $dbimp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();

if ($tipo == "port") {
    echo "<h1> Permiso muelle puerto '$nombre_puerto' </h1>";
}
else {
    echo "<h1> Permiso astillero puerto";
    echo $nombre_puerto;
    echo "</h1>";
    $fecha_salida = $_POST["fecha_salida"];
}

// Acá el resultado depende de si es que existen instalaciones disponibles o no. En caso de haber más de una disponible se utiliza la instalación de menor id

?>
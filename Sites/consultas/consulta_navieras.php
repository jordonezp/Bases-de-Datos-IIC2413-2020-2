<?php

require('../config/conection.php');

$nid = $_GET["nid"];
$nnombre = $_GET["nnombre"]; 

$query_carga = "SELECT buque.bnombre, buque.patente FROM buque, carga WHERE nid = 'Snid' AND buque.patente = carga.patente;";
$query_pesquero = "SELECT buque.bnombre, buque.patente FROM buque, pesquero WHERE nid = 'Snid' AND buque.patente = pesquero.patente;";
$query_petrolero = "SELECT buque.bnombre, buque.patente FROM buque, petrolero WHERE nid = 'Snid' AND buque.patente = petrolero.patente;";
$result_carga = $dbp->prepare($query_carga);
$result_pesquero = $dbp->prepare($query_pesquero);
$result_petrolero = $dbp->prepare($query_petrolero);
$result_carga->execute();
$result_pesquero->execute();
$result_petrolero->execute();
$tabla_carga = $result_carga->fetchAll();
$tabla_pesquero = $result_pesquero->fetchAll();
$tabla_petrolero = $result_petrolero->fetchAll();

?>

<h1> Buques de <?php echo $nnombre ?> </h1>

<p> A continuación se listan las patente y nombres de los buques de la naviera <?php echo 
    $nnombre ?> por tipo de buque. </p>

<?php
foreach ($tabla_carga as $fila) {
    echo "<tr> <td> $fila[0] </td> <td> $fila[1] </td> </tr>";
}
?>

<?php
if (count($tabla_carga) >= 1) {
    echo "<h2> Buques de Carga </h2>";
    echo "<table>";
    echo "<tr>";
         echo "<th>Nombre</th>";
         echo "<th>Patente</th>";
    echo "</tr>";
    foreach ($tabla_carga as $fila) {
        echo "<tr> <td> $fila[0] </td> <td> $fila[1] </td> </tr>";
    }
}

if (count($tabla_pesquero) >= 1) {
    echo "<h2> Buques Pesqueros </h2>";
    echo "<table>";
    echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Patente</th>";
    echo "</tr>";
    foreach ($tabla_pesquero as $fila) {
        echo "<tr> <td> $fila[0] </td> <td> $fila[1] </td> </tr>";
    }
}

if (count($tabla_petrolero) >= 1) {
    echo "<h2> Buques Petroleros </h2>";
    echo "<table>";
    echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Patente</th>";
    echo "</tr>";
    foreach ($tabla_petrolero as $fila) {
        echo "<tr> <td> $fila[0] </td> <td> $fila[1] </td> </tr>";
    }
}

?>
<?php session_start();?>
<?php include('templates/header.html');   ?>
<?php include('navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../config/conection.php');

$nid = $_GET["nid"];
$nnombre = $_GET["nnombre"];

$query_carga = "SELECT buque.bnombre, buque.patente FROM buque, carga WHERE nid = '$nid' AND buque.patente = carga.patente;";
$query_pesquero = "SELECT buque.bnombre, buque.patente FROM buque, pesquero WHERE nid = '$nid' AND buque.patente = pesquero.patente;";
$query_petrolero = "SELECT buque.bnombre, buque.patente FROM buque, petrolero WHERE nid = '$nid' AND buque.patente = petrolero.patente;";
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
    echo "</table>";
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
    echo "</table>";
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
    echo "</table>";
}

?>


<form action="../navieras.php" method="get">
    <input class="button is-link" type="submit" value="Volver">
</form>
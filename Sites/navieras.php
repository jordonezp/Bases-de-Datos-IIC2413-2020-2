<?php
require('./config/conection.php');
$query = "SELECT * FROM naviera;";
$result = $dbp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>

<h1>Navieras</h1>

<p>Acá podrás revisar las navieras existentes. Haciendo <i>clcik</i> sobre una naviera podrás
    acceder a los barcos de esta.</p>
<br>

<table>
    <tr>
        <th>Nombre</th>
    </tr>

    <?php
    foreach ($tabla as $fila) {
        echo "<tr><td><a href='consultas/consulta_navieras.php?nid=$fila[0]'> $fila[1] </a></td> </tr>";
    }
    ?>

</table>

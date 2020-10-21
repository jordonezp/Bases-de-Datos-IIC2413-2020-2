<?php
require('./config/conection.php');
$query = "SELECT DISTINCT nnombre FROM naviera;";
$result = $dbp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>

<h1>Navieras</h1>
<br>

<p>Acá podrás revisar las navieras existentes y acceder a los barcos de cada una de estas</p>
<br>
<br>

<table>
    <tr>
        <th>Nombre</th>
        <th>Acción</th>
    </tr>

    <?php
    foreach ($tabla as $fila) {
        echo "<tr><td>$fila[1]</td> </tr>";
    }
    ?>

</table>

<?php
require('./config/conection.php');
$query = "SELECT * FROM ports;";
$result = $dbimp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>

<h1>Puertos</h1>

<p>Acá podrás revisar los puertos existentes. Haciendo <i>clcik</i> sobre un puertos podrás
    realizar consultas sobre este puerto</p>
<br>

<table>
    <tr>
        <th>Nombre</th>
    </tr>

    <?php
    foreach ($tabla as $fila) {
        echo "<tr> <td> <a href='consultas/consulta_puertos.php?pid=$fila[0]&name=$fila[1]'> $fila[1] </a> </td> </tr>";
    }
    ?>

</table>

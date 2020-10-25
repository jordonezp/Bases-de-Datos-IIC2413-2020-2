<?php session_start();?>

<?php
require('./config/conection.php');
$query = "SELECT * FROM ports;";
$result = $dbimp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>
<?php include('templates/header.html');   ?>
<?php include('navbar.php'); ?>
<br/><br/><br/>

<div class="container is-max-desktop">

  <h1 class="title">Puertos</h1>
    <h2 class="subtitle">Acá podrás revisar los puertos existentes. Haciendo <i>click</i> sobre un puerto podrás
    realizar consultas sobre este puerto</h2>
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
</div>
<div class="container is-max-desktop">

<form action="index.php" method="get">
    <input class="button is-link" type="submit" value="Volver">
</form>
</div>
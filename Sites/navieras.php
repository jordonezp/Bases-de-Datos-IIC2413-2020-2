<?php session_start();?>

<?php
require('./config/conection.php');
if (isset($_POST["submit"])) {
    $nombre = strtoupper($_POST["nombre"]);
    $query = "SELECT * FROM naviera WHERE UPPER(nnombre) LIKE '%$nombre%';";
}
else {
    $query = "SELECT * FROM naviera   ;";
}
$result = $dbp -> prepare($query);
$result -> execute();
$tabla = $result -> fetchAll();
?>
<?php include('templates/header.html');   ?>
<?php include('navbar.php'); ?>
<br/><br/><br/>

<div class="container is-max-desktop">

  <h1 class="title">Navieras</h1>
    <h2 class="subtitle">Acá podrás revisar las navieras existentes. Haciendo <i>click</i> sobre una naviera podrás
    acceder a los barcos de esta.</h2>

    <!-- Acá va el form para filtrar-->
    <p> Filtrar por nombre</p>
    <form action="navieras.php" method="post">
        <input class="button is-link" type="text" name="nombre" placeholder="Nombre...">
        <input class="button is-link" type="submit" value="Filtrar" name="submit">
    </form>
    </br>
    </br>

  <table>
    <tr>
        <th>Nombre</th>
    </tr>

    <?php
    foreach ($tabla as $fila) {
        echo "<tr> <td> <a href='consultas/consulta_navieras.php?nid=$fila[0]&nnombre=$fila[1]'> $fila[1] </a> </td> </tr>";
    }
    ?>

</table>
</div>
<br/><br/><br/>
<div class="container is-max-desktop">
<form action="index.php" method="get">
    <input class="button is-link" type="submit" value="Volver">
</form>
</div>



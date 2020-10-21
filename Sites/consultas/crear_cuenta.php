<?php session_start();   ?>
<?php include('../templates/header.html');   ?>
<?php include('../navbar.php'); ?>
<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $pasaporte = $_POST["pasaporte"];
    $pass = $_POST["pass"];
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];
    $nacio = $_POST["nacio"];


    $query = "SELECT usuarios.pasaporte
              FROM usuarios
              WHERE '$pasaporte' = usuarios.pasaporte;";
    $result = $db -> prepare($query);
	$result -> execute();
	$nav = $result -> fetchAll();



	$query_all = "SELECT *
              FROM usuarios;";

    $result_all = $dbp -> prepare($query_all);
	$result_all -> execute();
	$all = $result_all -> fetchAll();
    $last = end($all);
    $uid = $last[0];
    $query = pg_query($dbp, "INSERT INTO usuarios (uid, nombre, pasaporte, nacionalidad, password, edad, sexo) VALUES ('$uid', '$nombre', '$pasaporte', '$nacio', '$password', '$edad', '$sexo);");

    ?>

        <br>
    <br>
<?php

if (sizeof($nav) == 1) {
    echo "Existe";

} elseif (sizeof($nav) == 0) {
    echo "No existe";
} else {
    echo "Hay 2 ????";
}
?>

<div class="container is-max-desktop">
    <h1 class="title">Cuenta</h1>
    <p class="subtitle">Bienvenido: <?php echo "$name" ?> !</p>
    <table class="table is-striped is-hoverable">
        <tr>
            <th>Pasaporte</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Nacionalidad</th>
        </tr>
        <?php
            foreach ($nav as $n) {
                echo "<tr>
                    <td>$n[0]</td>
                    <td>$n[1]</td>
                    <td>$n[2]</td>
                    <td>$n[3]</td>
                    <td>$n[4]</td>
                </tr>";
            }
        ?>
    </table>
    </div>
</body>
<?php include('../templates/footer.html'); ?>

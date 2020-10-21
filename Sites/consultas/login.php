<?php session_start();   ?>
<?php include('../templates/header.html');   ?>
<?php include('../navbar.php'); ?>
<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $pasaporte = $_POST["pasaporte"];
    $clave = $_POST["clave"];


    $query = "SELECT usuarios.pasaporte, usuarios.nombre, usuarios.edad, usuarios.sexo, usuarios.nacionalidad
              FROM usuarios
              WHERE '$pasaporte' = usuarios.pasaporte and usuarios.password = '$clave';";
    $result = $dbp -> prepare($query);
	$result -> execute();
	$nav = $result -> fetchAll();
    ?>

        <br>
    <br>

<?php

if (sizeof($nav) == 1) {
    echo "Existe";
    $name = $nav[0][1];
    $_SESSION['name']=$name;
    $_SESSION['pasaporte']=$nav[0][0];
    echo '$_SESSION["name"]';

} elseif (sizeof($nav) == 0) {
    echo "No existe";
    $name = "ERROR 404";
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

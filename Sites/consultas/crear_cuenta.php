<?php session_start();   ?>
<?php include('../templates/header.html');   ?>
<?php include('../navbar.php'); ?>
<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conection.php");

    $pasaporte = $_POST["pasaporte"];
    $pass = $_POST["pass"];
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];
    $nacio = $_POST["nacio"];


    $query = "SELECT usuarios.pasaporte
              FROM usuarios
              WHERE '$pasaporte' = usuarios.pasaporte;";
    $result = $dbp -> prepare($query);
	$result -> execute();
	$nav = $result -> fetchAll();



	$query_all = "SELECT *
              FROM usuarios;";

    $result_all = $dbp -> prepare($query_all);
	$result_all -> execute();
	$all = $result_all -> fetchAll();
    $last = end($all);
    $uid = $last[0];
    $sql = "INSERT INTO usuarios (uid, nombre, pasaporte, nacionalidad, password, edad, sexo) VALUES (?,?,?,?,?,?,?)";
    $stmt = $dbp -> prepare($sql);
    $stmt -> execute([$pasaporte, $pass, $nombre, $edad, $sexo, $nacio]);

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
    <h1 class="title">Cuenta Creada Satisfactoriamente ! :D</h1>
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
                echo "<tr>
                    <td>$pasaporte</td>
                    <td>$pass</td>
                    <td>$nombre</td>
                    <td>$edad</td>
                    <td>$sexo</td>
                    <td>$nacio</td>
                    
                </tr>";
            
        ?>
    </table>
    </div>
</body>
<?php include('../templates/footer.html'); ?>

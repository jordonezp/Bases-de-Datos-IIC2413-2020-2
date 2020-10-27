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
    $result = $dbimp -> prepare($query);
	$result -> execute();
	$nav = $result -> fetchAll();



	$query_all = "SELECT * FROM usuarios;";
    $result_all = $dbimp -> prepare($query_all);
	$result_all -> execute();
	$all = $result_all -> fetchAll();
    $last = end($all);
    $uid = (int)$last[0] + 1;
    $edad2 = (int)$edad;
    if (strlen($pass) != 6){
    echo '<br/><br/><div class="container is-max-desktop"> <h3 class="subtitle">Clave Invalida :/ </h3></div>';

    }
    elseif ($nav[0][0] != ""){
    echo'<br/><br/><div class="container is-max-desktop"> <h3 class="subtitle">Pasaporte Existente </h3></div>';
    }
    elseif (strlen($pass) > 0 and strlen($pasaporte) and strlen($nombre) and strlen($edad) and strlen($sexo) and strlen($nacio)){

        $sql = "INSERT INTO usuarios(uid, nombre, pasaporte, nacionalidad, password, edad, sexo) VALUES (?,?,?,?,?,?,?)";
        $stmt = $dbimp -> prepare($sql);
        $stmt -> execute([$uid, $nombre, $pasaporte, $nacio, $pass, $edad2, $sexo]);

        echo '<div class="container is-max-desktop">
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
                    <td>$nombre</td>
                    <td>$edad</td>
                    <td>$sexo</td>
                    <td>$nacio</td>

                </tr>";

        ?>
    </table>
    </div>
</body>';
    }
    else{
    echo '<br/><br/><div class="container is-max-desktop"> <h3 class="subtitle">Falto algun dato!! :/</h3></div>';
    }

    ?>
    <br>
    <br>




<?php include('../templates/footer.html'); ?>

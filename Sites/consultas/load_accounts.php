<?php session_start(); ?>
<?php include('../templates/header.html');   ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>

<div class="container is-max-desktop">
    <?php include('../templates/footer.html'); ?>
<?php
require("../config/conection.php");

$items = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", 
            "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7",
            "8", "9", "0"];


$query_cap = "SELECT pasaporte, capitan, penombre, edad, genero, nacionalidad FROM personal;";
$result = $dbp -> prepare($query_cap);
$result -> execute();
$caps = $result -> fetchAll();

foreach ($caps as $cap) {
    if ($cap[1] == "t") {
        $query_all = "SELECT * FROM usuarios;";
        $result_all = $dbimp -> prepare($query_all);
        $result_all -> execute();
        $all = $result_all -> fetchAll();
        $last = end($all);
        $uid = (int)$last[0] + 1;
        
        $pass = $items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)];
        $edad2 = (int)$cap[3];

        $sql = "INSERT INTO usuarios(uid, nombre, pasaporte, nacionalidad, password, edad, sexo) VALUES (?,?,?,?,?,?,?)";

        $query_2 = "SELECT pasaporte FROM usuarios WHERE pasaporte='$cap[0]'";
        $result2 = $dbimp -> prepare($query_2);
        $result2 -> execute();
        $data_q2 = $result2 -> fetchAll();

        if (sizeof($data_q2) > 0){
        }
        else{
        $stmt = $dbimp -> prepare($sql);
        $stmt -> execute([$uid, $cap[2], $cap[0], $cap[5], $pass, $edad2, $cap[4]]);
        }
        }
        }




$query_boss = "SELECT employees.rut, employees.name, employees.age, employees.sex
                FROM employees, facilities
                WHERE employees.rut = facilities.boss_rut;";
$result = $dbimp -> prepare($query_boss);
$result -> execute();
$bosses = $result -> fetchAll();
foreach ($bosses as $boss) {
    $query_all = "SELECT * FROM usuarios;";
    $result_all = $dbimp -> prepare($query_all);
    $result_all -> execute();
    $all = $result_all -> fetchAll();
    $last = end($all);
    $uid = (int)$last[0] + 1;
    
    $pass = $items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)];
    $edad2 = (int)$boss[2];

    $sql = "INSERT INTO usuarios(uid, nombre, pasaporte, nacionalidad, password, edad, sexo) VALUES (?,?,?,?,?,?,?)";
    $query_2 = "SELECT pasaporte FROM usuarios WHERE pasaporte='$boss[0]'";
        $result2 = $dbimp -> prepare($query_2);
        $result2 -> execute();
        $data_q2 = $result2 -> fetchAll();

        if (sizeof($data_q2) > 0){
        }
        else{
        $stmt = $dbimp -> prepare($sql);
        $stmt -> execute([$uid, $boss[1], $boss[0], "", $pass, $edad2, $boss[3]]);
        }
        }


?>
<?php
$query = "SELECT * FROM usuarios;";

    $result = $dbimp -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();

?>

    <div class="container is-max-desktop">
    <h1 class="title">Cuentas</h1>
    <p class="subtitle">Informacion cuentas cargadas </p>
    <table class="table is-striped is-hoverable">
        <tr>
        <th>uid</th>
        <th>Nombre</th>
        <th>Pasaporte</th>
        <th>Contraseña</th>
        <th>Nacionalidad</th>
        <th>Edad</th>
        <th>Sexo</th>
        </tr>


    <?php
    foreach ($dataCollected as $p) {
        echo "<tr> <td>$p[0]</td>
                    <td>$p[1]</td>
                    <td>$p[2]</td>
                    <td>$p[4]</td>
                    <td>$p[3]</td>
                    <td>$p[5]</td>
                    <td>$p[6]</td>
            </tr>";
    }
        ?>
    </table>
</div>


<div class="container is-max-desktop">
<?php include('../templates/footer.html'); ?>
</div>

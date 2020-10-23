<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>
<?php
require("../config/conection.php");

$pasaporte = $_POST["pasaporte"];
$clave = $_POST["clave"];

if ($_POST["pasaporte"] == ""){
$pasaporte = $_SESSION["pasaporte"];
$clave = $_SESSION["clave"];
}else{
$_SESSION["pasaporte"] = $_POST["pasaporte"];
$_SESSION["pass"] = $_POST["clave"];
$pasaporte = $_SESSION["pasaporte"];
$clave = $_SESSION["clave"];
}

// querys para clasificar tipo de persona
$query = "SELECT personal.pasaporte FROM personal
            WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte';";
$result = $dbp -> prepare($query);
$result -> execute();
$capitan = $result -> fetchAll();

$query = "SELECT f.boss_rut FROM facilities f
            WHERE f.boss_rut = '$pasaporte';";
$result = $dbimp -> prepare($query);
$result -> execute();
$jefe = $result -> fetchAll();

echo $jefe[0][0];
if (sizeof($capitan) == 1) {
//CAPITAN
    $tipo_usuario = "capitan";
    echo "<div class="container is-max-desktop"> <h2> Perfil capital</h2></div>";

    $query = "SELECT personal.patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte';";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $patente_capitan = $result -> fetchAll();
    $p = $patente_capitan[0][0];
    echo "<div class="container is-max-desktop"> <h3>Patente del buque:</h3><h3>'$p'</h3></div>";

    $query = "SELECT buque.bnombre FROM buque 
    WHERE buque.patente 
    IN (SELECT personal.patente AS patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte');";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $bnombre_capitan = $result -> fetchAll();
    $b = $bnombre_capitan[0][0];

    echo "<h3>Nombre del buque:</h3>";
    echo $b;

    $query = "SELECT naviera.nnombre FROM naviera 
    WHERE naviera.nid IN (SELECT buque.nid FROM buque 
    WHERE buque.patente IN (SELECT personal.patente AS patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte'));";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $naviera_capitan = $result -> fetchAll();
    $n = $naviera_capitan[0][0];

    echo "<h3>Naviera:</h3>";
    echo "<p>$n</p>";

    $query = "SELECT puerto.punombre FROM puerto 
    WHERE puerto.puid IN (SELECT historialatraque.puid AS puertos FROM historialatraque 
    WHERE historialatraque.patente IN (SELECT personal.patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte') 
    GROUP BY historialatraque.fecha, historialatraque.puid 
    ORDER BY historialatraque.fecha DESC LIMIT 5);";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $puertos_capitan = $result -> fetchAll();
    echo "<h3>Puertos:</h3>";
    $p = $puertos_capitan;
    foreach ($p as $p2) {
        echo "<tr> <td>$p2[0]</td>
            </tr>";
    }

} 
//JEFE
elseif(sizeof($jefe) == 1) {

    $tipo_usuario = "jefe";

    $query = "SELECT ports.name FROM ports, employees e, facilities f
                WHERE f.boss_rut = '$pasaporte' AND f.pid = ports.pid 
                GROUP BY ports.name;";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $puerto_jefe = $result -> fetchAll();
    $p = $puerto_jefe[0][0];

    $query = "SELECT s.fid FROM shipyards s, facilities fa 
                WHERE fa.boss_rut ='$pasaporte' AND s.fid = fa.fid;";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $tipo_jefe = $result -> fetchAll();
    $t = $tipo_jefe[0][0];

    if (sizeof($tipo_jefe) == 1) {
        echo "Jefe de un Shipyard";
        $tipo_inst_jefe = "Shipyard";
        
    } elseif (sizeof($tipo_jefe) == 0) {
        echo "Jefe de un Dock";
        $tipo_inst_jefe = "Dock";

    } else {
        echo "Hay 2 ????";
    }
    }

//OTRO
else{
    $tipo_usuario = "otro";
}
?>
</body>
<?php include('../templates/footer.html'); ?>


<?php
require("../config/conection.php");

$pasaporte = $_POST["pasaporte"];
$pass = $_POST["pass"];
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$sexo = $_POST["sexo"];
$nacio = $_POST["nacio"];

// querys para clasificar tipo de persona
$query = "SELECT personal.pasaporte FROM personal 
            WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte';";
$result = $dbp -> prepare($query);
$result -> execute();
$capitan = $result -> fetchAll();

$query = "SELECT f.boss_rut FROM facilities f
            WHERE f.boss_rut = '$pasaporte';";
$result = $dbp -> prepare($query);
$result -> execute();
$jefe = $result -> fetchAll();


if (sizeof($capitan) == 1) {
//CAPITAN
    $tipo_usuario = "capitan";
    echo "<h2> Perfil capital</h2>";

    $query = "SELECT personal.patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte';";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $patente_capitan = $result -> fetchAll();

    echo "<h3>Patente del buque:</h3>";
    echo "<p>'$patente_capitan'</p>";

    $query = "SELECT buque.bnombre FROM buque 
    WHERE buque.patente 
    IN (SELECT personal.patente AS patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte');";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $bnombre_capitan = $result -> fetchAll();

    echo "<h3>Nombre del buque:</h3>";
    echo "<p>'$bnombre_capitan'</p>";

    $query = "SELECT naviera.nnombre FROM naviera 
    WHERE naviera.nid IN (SELECT buque.nid FROM buque 
    WHERE buque.patente IN (SELECT personal.patente AS patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte'));";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $naviera_capitan = $result -> fetchAll();

    echo "<h3>Naviera:</h3>";
    echo "<p>$naviera_capitan</p>";

    $query = "SELECT puerto.punombre FROM puerto 
    WHERE puerto.puid IN (SELECT historialatraque.puid AS puertos FROM historialatraque 
    WHERE historialatraque.patente IN (SELECT personal.patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte') 
    GROUP BY historialatraque.fecha, historialatraque.puid 
    ORDER BY historialatraque.fecha DESC LIMIT 5);";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $puertos_capitan = $result -> fetchAll();
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

    $query = "SELECT s.fid FROM shipyards s, facilities fa 
                WHERE fa.boss_rut ='$pasaporte' AND s.fid = fa.fid;";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $tipo_jefe = $result -> fetchAll();

    if (sizeof($tipo_jefe) == 1) {
        echo "Jefe de un Shipyard";
        $tipo_inst_jefe = "Shipyard";
        
    } elseif (sizeof($nav) == 0) {
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
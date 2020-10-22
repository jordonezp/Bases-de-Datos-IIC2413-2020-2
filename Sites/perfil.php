

<?php
require("../config/conection.php");

$pasaporte = $_POST["pasaporte"];
$pass = $_POST["pass"];
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$sexo = $_POST["sexo"];
$nacio = $_POST["nacio"];


//CAPITAN

$query = "SELECT personal.patente FROM personal 
            WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte';";
$result = $dbp -> prepare($query);
$result -> execute();
$patente_capitan = $result -> fetchAll();

$query = "SELECT buque.bnombre FROM buque 
            WHERE buque.patente 
            IN (SELECT personal.patente AS patente FROM personal 
            WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte');";
$result = $dbp -> prepare($query);
$result -> execute();
$bnombre_capitan = $result -> fetchAll();

$query = "SELECT naviera.nnombre FROM naviera 
            WHERE naviera.nid IN (SELECT buque.nid FROM buque 
            WHERE buque.patente IN (SELECT personal.patente AS patente FROM personal 
            WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte'));";
$result = $dbp -> prepare($query);
$result -> execute();
$naviera_capitan = $result -> fetchAll();

$query = "SELECT puerto.punombre FROM puerto 
            WHERE puerto.puid IN (SELECT historialatraque.puid AS puertos FROM historialatraque 
            WHERE historialatraque.patente IN (SELECT personal.patente FROM personal 
            WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte') 
            GROUP BY historialatraque.fecha, historialatraque.puid 
            ORDER BY historialatraque.fecha DESC LIMIT 5);";
$result = $dbp -> prepare($query);
$result -> execute();
$puertos_capitan = $result -> fetchAll();



//JEFE
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
$tipo_instalacion_jefe = $result -> fetchAll();


?>
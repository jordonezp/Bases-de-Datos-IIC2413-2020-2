<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>
<?php include('../templates/header.html');   ?>
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

$query = "SELECT * FROM usuarios 
WHERE usuarios.pasaporte = '$pasaporte' AND usuario.password = '$clave';";
$result = $dbimp -> prepare($query);
$result -> execute();
$datos_usuario = $result -> fetchAll();
if ($datos_usario[0][0] != ""){
    $sesion_on = TRUE;
}

else {
    $sesion_on = FALSE;
}

?>

<?php

if ($sesion_on == FALSE){
echo '<br/><br/><div class="container is-max-desktop"> <h3 class="subtitle">No hay sesion iniciada</h3></div>
<br/><br/>
<div class="container is-max-desktop">
  <h1 class="title">Login</h1>
    <h2 class="subtitle">Ingresa a tu cuenta</h2>
        <form align="center" action="perfil.php" method="post">
            Pasaporte:
            <input class="input is-rounded" style="width: 33%;" type="text" name="pasaporte">
            <br/><br/>
            Contraseña:
            <input class="input is-rounded" style="width: 33%;" type="text" name="clave">
            <br/><br/>
            <input class="button is-link" type="submit" value="Ingresar">
        </form>
  </div>
  <br/><br/>

  <div class="container is-max-desktop">
  <h1 class="title">Creador de cuenta</h1>
  <p class="subtitle">Ingresa tu informacion.</p>
        <form align="center" action="crear_cuenta.php" method="post">
            Pasaporte:
            <input class="input is-rounded" style="width: 33%;" type="text" name="pasaporte">
            <br><br> <br>
            Contraseña:
            <input class="input is-rounded" style="width: 33%;" type="text" name="pass">
            <br><br> <br>
            Nombre:
            <input class="input is-rounded" style="width: 33%;" type="text" name="nombre">
            <br><br> <br>
            Edad:
            <input class="input is-rounded" style="width: 33%;" type="text" name="edad">
            <br><br> <br>
            Sexo:
            <input class="input is-rounded" style="width: 33%;" type="text" name="sexo">
            <br><br> <br>
            Nacionalidad:
            <input class="input is-rounded" style="width: 33%;" type="text" name="nacio">
            <br/><br/>
            <input class="button is-link" type="submit" value="Crear">
        </form>
  </div>
  '



  ;

}else{

//INFORMACIÓN PERSONAL -LEFT COLUMN (independiente del tipo de persona)
echo '<div class="container is-max-desktop"> <h4 class="title"><strong>Datos personales</strong></div>';
echo '<br>';

// querys para clasificar tipo de persona (capitan, jefe, otro)
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


//echo $jefe[0][0];
if (sizeof($capitan) == 1) {
//CAPITAN

    $tipo_usuario = "Perfil Capitan";
    echo '<br>';
    echo '<div class="container is-max-desktop"> <h3 class="title">'.$tipo_usuario.'</h3></div>';
    echo '<br>';

    //patente
    $query = "SELECT personal.patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte';";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $patente_capitan = $result -> fetchAll();
    $p = $patente_capitan[0][0];
    $pat = "Patente del Buque:";
    echo '<div class="container is-max-desktop"> <h4 class="subtitle"><strong>'.$pat.'</strong></h4><p>'.$p.'</p></div>';
    echo '<br>';

    //nombre de buque
    $query = "SELECT buque.bnombre FROM buque 
    WHERE buque.patente 
    IN (SELECT personal.patente AS patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte');";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $bnombre_capitan = $result -> fetchAll();
    $b = $bnombre_capitan[0][0];
    echo '<div class="container is-max-desktop"><h4 class="subtitle"><strong>Nombre del buque:</strong></h4>';
    echo '<div class="container is-max-desktop"><p>'.$b.'</p>';
    echo '<br>';

    //nombre naviera
    $query = "SELECT naviera.nnombre FROM naviera 
    WHERE naviera.nid IN (SELECT buque.nid FROM buque 
    WHERE buque.patente IN (SELECT personal.patente AS patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte'));";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $naviera_capitan = $result -> fetchAll();
    $n = $naviera_capitan[0][0];
    echo '<div class="container is-max-desktop"><h4 class="subtitle"><strong>Naviera:</strong></h4>';
    echo '<div class="container is-max-desktop"><p>'.$n.'</p>';
    echo '<br>';
    echo '<br>';
    //próximo itinerario (con fecha)
    // FALTA!! NO LO HABÍAMOS ANOTADO
    $query = "SELECT pi.fecha, pu.punombre 
            FROM proxitinerario pi, puerto pu 
            WHERE pi.patente ='$p' AND pu.puid=pi.puid 
            ORDER BY pi.fecha ASC LIMIT 1;";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $itinerario = $result -> fetchAll();
    $i = $itinerario[0][0];
    $i2 = $itinerario[0][1];
    
    echo '<div class="container is-max-desktop"><h4 class="subtitle"><strong>Próximo itinerario:</strong></h4>';
    echo '<div class="container is-max-desktop"><p>'.$i.', '.$i2.'</p>';
    //echo '<div class="container is-max-desktop"><p>'.$itinerario'</p>';
    echo '<br>';


    //ultimos 5 lugares en que ha estado
    $query = "SELECT puerto.punombre FROM puerto 
    WHERE puerto.puid IN (SELECT historialatraque.puid AS puertos FROM historialatraque 
    WHERE historialatraque.patente IN (SELECT personal.patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte') 
    GROUP BY historialatraque.fecha, historialatraque.puid 
    ORDER BY historialatraque.fecha DESC LIMIT 5);";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $puertos_capitan = $result -> fetchAll();
    echo '<div class="container is-max-desktop"><h4 class="subtitle"><strong>Puertos:</strong></h4>';
    $p = $puertos_capitan;
    foreach ($p as $p2) {
        echo '<div class="container is-max-desktop">
                <tr><td><p>'.$p2[0].'</p></td></tr></div>';
    }
    echo '<br>';
} 


//JEFE

elseif(sizeof($jefe) == 1) {

    $tipo_usuario = "Jefe";

    //puerto en el que trabaja
    $query = "SELECT ports.name FROM ports, employees e, facilities f
                WHERE f.boss_rut = '$pasaporte' AND f.pid = ports.pid 
                GROUP BY ports.name;";
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $puerto_jefe = $result -> fetchAll();
    $puertoj = $puerto_jefe[0][0];
    echo '<div class="container is-max-desktop"><h4 class="subtitle"><strong>Nombre de puerto:</strong></h4>';
    echo '<div class="container is-max-desktop"><p>'.$puertoj.'</p>';
    echo '<br/>';

    //jefe de qué tipo de instalación:
    $query = "SELECT s.fid FROM shipyards s, facilities fa 
                WHERE fa.boss_rut ='$pasaporte' AND s.fid = fa.fid;";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $tipo_jefe = $result -> fetchAll();
    $t = $tipo_jefe[0][0];
        
    if (sizeof($tipo_jefe) == 1) {
        $tipo_inst_jefe = "Shipyard";
        
    } elseif (sizeof($tipo_jefe) == 0) {
        $tipo_inst_jefe = "Dock";

    } else {
        echo "Hay 2 ????";
    }

    echo '<div class="container is-max-desktop"><h4 class="subtitle">
            <strong>Tipo de instalación:</strong></h4></div>';
    echo '<div class="container is-max-desktop">
    <p>Jefe de un '.$tipo_inst_jefe.'</p></div>';
    echo '<br/>';
    }
    
//OTRO
else{
    $tipo_usuario = "otro";
}

$query = "SELECT * FROM usuarios 
WHERE usuarios.pasaporte = '$pasaporte';";
$result = $dbimp -> prepare($query);
$result -> execute();
$datos_usuario = $result -> fetchAll();
$nombre = $datos_usuario[0][1];
$nacionalidad = $datos_usuario[0][3];
$edad = $datos_usuario[0][5];
$sexo = $datos_usuario[0][6];

echo '<br>';
echo '<div class="container is-max-desktop"> <h4 class="subtitle"><strong>Nombre: </strong></h4><p>'.$nombre.'</p></div>';
echo '<br>';
echo '<div class="container is-max-desktop"> <h4 class="subtitle"><strong>Edad: </strong></h4><p>'.$edad.'</p></div>';
echo '<br>';
echo '<div class="container is-max-desktop"> <h4 class="subtitle"><strong>Sexo: </strong></h4><p>'.$sexo.'</p></div>';
echo '<br>';
echo '<div class="container is-max-desktop"> <h4 class="subtitle"><strong>Pasaporte/RUT: </strong></h4><p>'.$pasaporte.'</p></div>';
echo '<br>';

if (strlen($nacionalidad) == 0) {
    echo '<div class="container is-max-desktop"> <h4 class="subtitle"><strong>Nacionalidad: </strong></h4><p>Nacionalidad no reportada</p></div>';
}
else{
    echo '<div class="container is-max-desktop"> <h4 class="subtitle"><strong>Nacionalidad: </strong></h4><p>'.$nacionalidad.'</p></div>';
}
echo '<br>';


echo '<div class="container is-max-desktop">
    <form align="center" action="./logout.php" method="post">
        <br/><br/>
        <input class="button is-link" type="submit" value="Log-Out">
    </form>
</div>
<br/><br/>
<div class="container is-max-desktop">
    <form align="center" action="./change_pass.php" method="post">
        <br/><br/>

        <input class="button is-link" type="submit" value="Cambiar Contraseña">
    </form>
</div>
';
}
?>

<div class="container is-max-desktop">
    <?php include('../templates/footer.html'); ?>
</div>

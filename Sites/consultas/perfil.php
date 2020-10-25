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

//echo $jefe[0][0];

if (sizeof($capitan) == 1) {
//CAPITAN
    $tipo_usuario = "Perfil Capitan";

    echo '<div class="container is-max-desktop"> <h3 class="title">'.$tipo_usuario.'</h3></div>';

    $query = "SELECT personal.patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte';";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $patente_capitan = $result -> fetchAll();
    $p = $patente_capitan[0][0];
    $pat = "Patente del Buque:";
    echo '<div class="container is-max-desktop"> <h4 class="sub-title">'.$pat.'</h4><p>'.$p.'</p></div>';
    echo '<br>'

    $query = "SELECT buque.bnombre FROM buque 
    WHERE buque.patente 
    IN (SELECT personal.patente AS patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte');";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $bnombre_capitan = $result -> fetchAll();
    $b = $bnombre_capitan[0][0];

    echo '<div class="container is-max-desktop"><h4 class="sub-title">Nombre del buque:</h4>';
    echo '<div class="container is-max-desktop"><p>'.$b.'</p>';

    $query = "SELECT naviera.nnombre FROM naviera 
    WHERE naviera.nid IN (SELECT buque.nid FROM buque 
    WHERE buque.patente IN (SELECT personal.patente AS patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte'));";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $naviera_capitan = $result -> fetchAll();
    $n = $naviera_capitan[0][0];

    echo '<div class="container is-max-desktop"><h4 class="sub-title">Naviera:</h4>';
    echo '<div class="container is-max-desktop"><p>'.$n.'</p>';

    $query = "SELECT puerto.punombre FROM puerto 
    WHERE puerto.puid IN (SELECT historialatraque.puid AS puertos FROM historialatraque 
    WHERE historialatraque.patente IN (SELECT personal.patente FROM personal 
    WHERE personal.capitan = True AND personal.pasaporte = '$pasaporte') 
    GROUP BY historialatraque.fecha, historialatraque.puid 
    ORDER BY historialatraque.fecha DESC LIMIT 5);";
    $result = $dbp -> prepare($query);
    $result -> execute();
    $puertos_capitan = $result -> fetchAll();
    echo '<div class="container is-max-desktop"><h4 class="sub-title">Puertos:</h4>';
    $p = $puertos_capitan;
    foreach ($p as $p2) {
        echo '<div class="container is-max-desktop">
                <tr><td><p>' .$p2[0].'</p></td></tr>';
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


<?php
if ($pasaporte == ""){
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


<?php include('../templates/footer.html'); ?>


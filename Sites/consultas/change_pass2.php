<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>
<?php include('../templates/header.html');   ?>

<?php
require('../config/conection.php');
$old = $_POST["old"];
$new = $_POST["new"];
$pas = $_SESSION["pasaporte"];


$query = "SELECT pasaporte, password FROM usuarios WHERE pasaporte='$pas' AND password='$old';";
$result = $dbimp -> prepare($query);
$result -> execute();
$len = $result -> fetchAll();
if (sizeof($new) != 6){
echo '<br/><br/><div class="container is-max-desktop"> <h3 class="subtitle">Nueva Clave Invalida :/ </h3></div>';


}
elseif (sizeof($len) > 0){

echo '<br/><br/><div class="container is-max-desktop"><h3 class="subtitle"> Clave Cambiada correctamente :) </h3></div>';
    $sql = "UPDATE usuarios SET password='$new' WHERE pasaporte='$pas' AND password='$old';";
    $stmt = $dbimp -> prepare($sql);
    $stmt -> execute();
}
else{
echo '<br/><br/><div class="container is-max-desktop"> <h3 class="subtitle">Clave incorrecta :( </h3></div>';
}

?>
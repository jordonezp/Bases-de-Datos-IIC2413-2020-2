<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>
<?php include('../templates/header.html');   ?>

<?php
require('../config/conection.php');
$old = $_POST["old"];
$new = $_POST["new"];
$pas = $_SESSION["pasaporte"];
echo $old;
echo $new;
echo $pas;

$query = "SELECT pasaporte, password FROM usuarios WHERE pasaporte='$pas' AND password='$old';";
$result = $dbimp -> prepare($query);
$result -> execute();
$len = $result -> fetchAll();

if (sizeof($len) > 0){
echo "Clave Cambiada correctamente :)";
    $sql = "UPDATE usuarios SET password='$new' WHERE pasaporte='$pas' AND password='$old';";
    $stmt = $dbimp -> prepare($sql);
    $stmt -> execute();
}
else{
echo "Clave incorrecta :(";
}

?>
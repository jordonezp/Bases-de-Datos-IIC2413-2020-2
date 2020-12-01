<?php session_start();?>
<?php include('../../templates/header.html');   ?>
<?php include('../../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../../config/conection.php');

$userId = $_GET["userId"];
$forbidden = $_GET["forbidden"];
$desired = $_GET["desired"];
$required = $_GET["required"];

$userId_a = split(';', $userId);
$forbidden_a = split(';', $forbidden);
$desired_a = split(';', $desired);
$required_a = split(';', $required);

echo $userId_a;
echo $forbidden;
echo $desired;
echo $required;

function sendGet($url) {
    try{
        $response = file_get_contents($url);

        if ($response !== false) {
            return $response;
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
$url = "https://api-bdd-g-94-81.herokuapp.com/messages";

$response = sendGet($url);
$jsonData = json_decode($response, JSON_INVALID_UTF8_IGNORE);

?>
<div class="container is-max-desktop">
    <br>
    <h1 class="title">Buscar Mensaje</h1>
    <br>
    <p>En caso de ingresar múltiples términos, separar por ",". </p>
    
    <form align="center" action="textsearch_messages.php" method="get">
        <p>Usuario (id): </p>
        <input class="input is-rounded" style="width: 33%;" type="number" name="userId">
        <p>Prohibido: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="forbidden">
        <p>Deseado: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="desired">
        <p>Requerido: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="required">
        <br>
        <br>
        <input class="button is-link" type="submit" value="Buscar Mensajes">
    </form>
</div>


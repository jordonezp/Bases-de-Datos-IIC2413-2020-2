<?php session_start();?>
<?php include('../../templates/header.html');   ?>
<?php include('../../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../../config/conection.php');

// echo $usuario_id;
// echo "<br>";

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
    
    <form align="center" action="consultas_api/sent_messages.php" method="get">
        <p>Usuario (id): </p>
        <input class="input is-rounded" style="width: 33%;" type="number" name="prohibido">
        <p>Prohibido: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="prohibido">
        <p>Deseado: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="deseado">
        <p>Requerido: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="requerido">
        <input class="button is-link" type="submit" value="Buscar Mensajes">
    </form>
</div>

"userId": 212,
	"forbidden": ["magikarp", "se"],
	"desired": ["shrek"],
	"required": ["que"]

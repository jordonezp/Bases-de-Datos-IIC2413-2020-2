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

$forbidden_a = preg_split("/[;]+/", $forbidden);
$desired_a = preg_split("/[;]+/", $desired);
$required_a = preg_split("/[;]+/", $required);

echo $userId;
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
$url = "https://bdd-e5-g9481.herokuapp.com/text-search";

$ch = curl_init($url);

$data = array(
    'userId' => $userId,
    'forbidden' => $forbidden_a
    'desired' => $desired_a
    'required' => $required_a
);
$payload = json_encode(array("user" => $data));

curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

$response = $result;
$jsonData = json_decode($response, JSON_INVALID_UTF8_IGNORE);

?>
<div class="container is-max-desktop">
    <br>
    <h1 class="title">Buscar Mensaje</h1>
    <br>
    <p>En caso de ingresar múltiples términos, separar por ",". </p>
    <br>
    
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

    <h2 class="title">Resultados</h2>
    <?php
    foreach ($forbidden_a as $f) {
        echo "$f\n";
    }
    foreach ($desired_a as $d) {
        echo "$d\n";
    }
    foreach ($required_a as $r) {
        echo "$r\n";
    }
    ?>
</div>


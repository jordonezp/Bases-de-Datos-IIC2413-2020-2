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

$userId = (int) $userId;
$forbidden_a = preg_split("/[;]+/", $forbidden);
$desired_a = preg_split("/[;]+/", $desired);
$required_a = preg_split("/[;]+/", $required);

// echo $userId;
// echo $forbidden;
// echo $desired;
// echo $required;

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
    'forbidden' => $forbidden_a,
    'desired' => $desired_a,
    'required' => $required_a
);
$payload = json_encode($data);

curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

// $response = $result;
$jsonData = json_decode($result, JSON_INVALID_UTF8_IGNORE);

?>
<div class="container is-max-desktop">
    <br>
    <h1 class="title">Buscar Mensaje</h1>
    <br>
    <p>En caso de ingresar múltiples términos, separar por ",". </p>
    <br>
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
    echo "payload: $payload\n";
    ?>
    
    <form align="center" action="send_message.php" method="get">
        <input type="hidden" name="sender" value=<?php echo $usuario_id ?> />
        <p>Receptor (id): </p>
        <input class="input is-rounded" style="width: 33%;" type="number" name="receptant">
        <p>message: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="message">
        <br>
        <br>
        <input class="button is-link" type="submit" value="Buscar Mensajes">
    </form>
</div>
"message": "Mensaje para probar el POST",
	"sender": 1,
	"receptant": 2,
	"lat": -46.059365,
	"long": -72.201691,
	"date": "2018-10-16"

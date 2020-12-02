<?php session_start();?>
<?php include('../../templates/header.html');   ?>
<?php include('../../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../../config/conection.php');


// "message": "Mensaje para probar el POST",
// 	"sender": 1,
// 	"receptant": 2,
// 	"lat": -46.059365,
// 	"long": -72.201691,
// 	"date": "2018-10-16"
$sender = $_GET["sender"];
$receptant = $_GET["receptant"];
$message = $_GET["message"];

$sender = (int) $sender;
$receptant = (int) $receptant;

// echo $userId;
// echo $forbidden;
// echo $desired;
// echo $required;

$url = "https://bdd-e5-g9481.herokuapp.com/messages";

$ch = curl_init($url);

$data = array(
    'sender' => $sender,
    'receptant' => $receptant,
    'message' => $message
);
$payload = json_encode($data);

curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

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
        echo "payload: $payload\n";
        echo "result: $result\n";
        echo 'User IP Address - '.$_SERVER['REMOTE_ADDR'];
        $res = file_get_contents("https://www.iplocate.io/api/lookup/$_SERVER['REMOTE_ADDR']");
        $res = json_decode($res);
        
        echo $res->country; // United States
        echo $res->continent; // North America
        echo $res->latitude; // 37.751
        echo $res->longitude; // -97.822
        
        var_dump($res);
    ?>
    
    <form align="center" action="send_message.php" method="get">
        <input type="hidden" name="sender" value=<?php echo $usuario_id ?> />
        <p>Receptor (id): </p>
        <input class="input is-rounded" style="width: 33%;" type="number" name="receptant">
        <p>Message: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="message">
        <br>
        <br>
        <input class="button is-link" type="submit" value="Buscar Mensajes">
    </form>
</div>

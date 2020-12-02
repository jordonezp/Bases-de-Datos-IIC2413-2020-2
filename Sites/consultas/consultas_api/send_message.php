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

$ip = $_SERVER['REMOTE_ADDR'];
$res = file_get_contents("https://www.iplocate.io/api/lookup/$ip");
$res = json_decode($res);

$lat = $res->latitude;
$long = $res->longitude;

$date = date("Y-m-d");

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
    'message' => $message,
    'sender' => $sender,
    'receptant' => $receptant,
    'lat' => $lat,
    'long' => $long,
    'date' => $date,
);
$payload = json_encode($data);

curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

if ($message !== null && $receptant !== 0) {
    echo 'enviado!!';
    $result = curl_exec($ch);
}

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
        // $ip = $_SERVER['REMOTE_ADDR'];
        // echo 'User IP Address - '.$ip;
        // $res = file_get_contents("https://www.iplocate.io/api/lookup/$ip");
        // $res = json_decode($res);
        
        // echo $res->country; // United States
        // echo $res->continent; // North America
        // echo $res->latitude; // 37.751
        // echo $res->longitude; // -97.822
        
        // var_dump($res);
    ?>
    
    <form align="center" action="send_message.php" method="get">
        <input type="hidden" name="sender" value=<?php echo $sender ?> />
        <p>Receptor (id): </p>
        <input class="input is-rounded" style="width: 33%;" type="number" name="receptant">
        <p>Message: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="message">
        <br>
        <br>
        <input class="button is-link" type="submit" value="Enviar">
    </form>
    <?php
        if ($result) {
            echo $result["success"];
        }
    ?>
</div>

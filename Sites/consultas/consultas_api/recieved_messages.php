<?php session_start();?>
<?php include('../../templates/header.html');   ?>
<?php include('../../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../../config/conection.php');

$usuario_id = $_GET["usuario_id"];

echo $usuario_id;
echo "<br>";

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
echo $response;

// $json = json_decode($response);
// echo $json;
$jsonData = json_decode($response, JSON_INVALID_UTF8_IGNORE);
// echo $jsonData;
echo '<pre>';
var_dump($jsonData);
echo '</pre>';

foreach ($jsonData as $m) {
    echo "\n m[0]: $m[0]";
    echo "\n\n m['date']: ";
    echo $m["date"];
}

?>

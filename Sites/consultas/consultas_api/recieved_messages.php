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
$url = "https://api-bdd-g-94-81.herokuapp.com/messages/$usuario_id";

$response = sendGet($url);
echo $response;

// $json = json_decode($response);
// echo $json;
$jsonData = json_decode($response, TRUE, 512, JSON_INVALID_UTF8_IGNORE);
// echo $jsonData;
echo '<pre>';
var_dump($jsonData);
echo '</pre>';

foreach ($jsonData[0] as $m) {
    echo $m;
}


$jsonData = json_decode($response, JSON_INVALID_UTF8_IGNORE);
// echo $jsonData;
echo '<pre>';
var_dump($jsonData);
echo '</pre>';

foreach ($jsonData[0] as $m) {
    echo $m;
}




// $string = sendGet($url);
// if ($string === false) {
//     echo "Api no retorna nada...";
// }
// $json_a = json_decode($string, true);
// if ($json_a === null) {
//     echo "Api retorna extraño...";
// }
// echo "json_a: ";
// echo $json_a;
// echo "\n\nreal stuff....\n";
// foreach ($json_a as $person_name) {
//     echo $person_name;
//     echo $person_name[0];
//     echo $person_name[0][0];
// }

?>

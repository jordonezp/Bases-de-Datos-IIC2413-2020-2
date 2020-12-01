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

$string = sendGet($url);
if ($string === false) {
    echo "Api no retorna nada...";
}
$json_a = json_decode($string, true);
if ($json_a === null) {
    echo "Api retorna extraño...";
}
echo $json_a;
foreach ($json_a as $person_name) {
    echo $person_name;
    echo $person_name[0];
    echo $person_name[0][0];
}

?>

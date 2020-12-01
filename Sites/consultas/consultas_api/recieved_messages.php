<?php session_start();?>
<?php include('../../templates/header.html');   ?>
<?php include('../../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../../config/conection.php');

$usuario_id = $_GET["usuario_id"];

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
$url = "https://bdd-e5-g9481.herokuapp.com/messages";

$response = sendGet($url);
$jsonData = json_decode($response, JSON_INVALID_UTF8_IGNORE);

?>
<div class="container is-max-desktop">
    <br>
    <h1 class="title">Mensajes Recibidos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>date</th>
                <th>lat</th>
                <th>long</th>
                <th>message</th>
                <th>mid</th>
                <th>receptant</th>
                <th>sender</th>
            </tr>
        </thead>

        <tbody>

        <?php
            foreach ($jsonData as $m) {
                $rec = $m["receptant"];
                if ("$rec" === $usuario_id) {
                    $date =  $m["date"];
                    $lat =  $m["lat"];
                    $long =  $m["long"];
                    $mid =  $m["mid"];
                    $message =  $m["message"];
                    $receptant =  $m["receptant"];
                    $sender =  $m["sender"];
                    echo "<tr><td>$date</td><td>$lat</td><td>$long</td><td>$mid</td><td>$message</td><td>$receptant</td><td>$sender</td></tr>";
                }
            }
        ?>
        </tbody>

    </table>
</div>

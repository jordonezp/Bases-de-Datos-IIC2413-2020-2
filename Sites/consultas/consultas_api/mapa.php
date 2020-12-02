<?php session_start();?>
<?php include('../../templates/header.html');   ?>
<?php include('../../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../../config/conection.php');

$userId = $_GET["userId"];
$desired = $_GET["desired"];
$start_date = $_GET["start_date"];
$end_date = $_GET["end_date"];

$userId = (int) $userId;
$desired_a = preg_split("/[;]+/", $desired);


$url = "https://bdd-e5-g9481.herokuapp.com/text-search";

$ch = curl_init($url);

$data = array(
    'userId' => $userId,
    'desired' => $desired_a,
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
    echo "payload: $payload\n";
    ?>
    
    <form align="center" action="mapa.php" method="get">
        <input type="hidden" name="sender" value=<?php echo $usuario_id ?> />
        <p>Usuario (id): </p>
        <input class="input is-rounded" style="width: 33%;" type="number" name="userId">
        <p>Palabras Clave: </p>
        <input class="input is-rounded" style="width: 33%;" type="text" name="desired">
        <p>Fecha inicio: </p>
        <input class="input is-rounded" style="width: 33%;" type="date" name="start_date">
        <p>Fecha final: </p>
        <input class="input is-rounded" style="width: 33%;" type="date" name="end_date">
        <br>
        <br>
        <input class="button is-link" type="submit" value="Buscar Mensajes">
    </form>

    <h2 class="title">Resultados</h2>
    
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
                $date =  $m["date"];
                if ($date > $start_date && $end_date > $data) {
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
    <br>
    <br>
    <?php
        echo $start_date;
        echo $end_date;
        echo $start_date < $end_date;
    ?>
</div>


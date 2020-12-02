<?php session_start();?>
<?php include('../../templates/header.html');   ?>
<?php include('../../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	crossorigin=""/>

<?php

require('../../config/conection.php');

$userId = $_GET["userId"];
$desired = $_GET["desired"];
$start_date = $_GET["start_date"];
$end_date = $_GET["end_date"];

$start_date = strtotime($start_date);
$end_date = strtotime($end_date);

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
                $date_date = strtotime($date);
                if ($date_date > $start_date && $end_date > $date_date) {
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
    <div id="mapid" style="height: 300px"></div>
    <?php
        // echo "start: $start_date\n";
        // echo "end: $end_date\n";
        // echo $start_date < $end_date;
    ?>
</div>
<?php 
    $lat = -33.5;
    $long = -70.5;
    $marker_list = [
        ["lat" => -33.4,
        "long" => -70.5],
        ["lat" => -33.6,
        "long" => -70.5],
        ["lat" => -33.5,
        "long" => -70.6],
    ];
?>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
<script>
    var map = L.map('mapid').setView([<?php echo $lat ?>, <?php echo $long ?>], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    <?php foreach($marker_list as $marker) {
        echo 
        'L.marker([' . $marker["lat"] . ',' . $marker["long"] . ']).addTo(map);';
    } ?>
</script>

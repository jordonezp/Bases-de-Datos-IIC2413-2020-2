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

$start_date_str = $start_date;
$end_date_str = $end_date;

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



$marker_list = [];
$marker_list2 = [];
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
        <input class="input is-rounded" style="width: 33%;" type="text" name="userId">
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

    <br>
    <br>
    <div id="mapid" style="height: 300px"></div>
    <br>
    <br>
    <?php
        // echo "start: $start_date\n";
        // echo "end: $end_date\n";
        // echo $start_date < $end_date;
    require('../../config/conection.php');
    
    $query = "SELECT * FROM users_json WHERE id = '$userId';";
    $result = $dbimp -> prepare($query);
    $result -> execute();
    $result_json = $result -> fetchAll();
    $id_json = $result_json[0][0];
    $id_description = $result_json[0][3];

    
    $query1 = "SELECT ic.pasaporte_rut FROM ids_cruzados ic WHERE ic.id = '$id_json';";
    $result2 = $dbimp -> prepare($query1);
    $result2 -> execute();
    $result2_json = $result2 -> fetchAll();
    $result2_json = $result2_json[0][0];


    echo $id_description;
    if(strpos($id_description, "jefe") == true){
        echo "Jefe Found!";
        $query_jefe = "SELECT pc.latitude, pc.longitud
                        FROM employees e 
                        INNER JOIN facilities f 
                        ON e.fid = f.fid
                        INNER JOIN puertos_completos pc
                        ON pc.pid = f.pid
                        WHERE '$result2_json'= e.rut;";
        $result_jefe = $dbimp -> prepare($query_jefe);
        $result_jefe -> execute();
        $lat_long_jefe = $result_jefe -> fetchAll();
        $lat_jefe = $lat_long_jefe[0][0];
        $long_jefe = $lat_long_jefe[0][1];
        array_push($marker_list2,[ "lat" => $lat_jefe, "long" => $long_jefe]);
        echo $lat_jefe;
        echo $long_jefe;
    } else{
        echo "Capitan Found!";
        $query_capitan_1 = "SELECT patente
                            FROM personal
                             WHERE '$result2_json'= personal.pasaporte;";
        $result_capitan_1 = $dbp -> prepare($query_capitan_1);
        $result_capitan_1 -> execute();
        $patentes = $result_capitan_1 -> fetchAll();
        $patente = $patentes[0][0];

        // echo "AAAAAAAAAAAAAAAAAAAAAAAAAAA";
        // echo "patente: ";
        // echo $patente;

        // echo "end_date_str: ";
        // echo $end_date_str;
        // echo "start_date_str: ";
        // echo $start_date_str;

        $query_capitan_2 = "SELECT p.punombre 
                            FROM historialatraque h, puerto p 
                             WHERE h.fecha_atraque >= '$start_date_str' AND
                                   h.fecha <= '$end_date_str' AND
                                   h.puid = p.puid AND
                                   h.patente = '$patente';";
        echo $query_capitan_2;
        echo '<br>';
        $result_capitan_2 = $dbp -> prepare($query_capitan_2);
        $result_capitan_2 -> execute();
        $puertos = $result_capitan_2 -> fetchAll();

        // echo "puertos: ";
        // echo $puertos;
        // echo "puertos[0]: ";
        // echo $puertos[0];
        // echo "puertos[0][0]: ";
        // echo $puertos[0][0];

        $coords_puertos = [];

        foreach ($puertos as $p) {
            // echo "p: ";
            // echo $p;
            // echo "p[0]: ";
            $puerto_nombre = $p[0];
            echo $puerto_nombre;
            $query_capitan_3 = "SELECT latitude, longitud FROM coordenadas_puertos WHERE puerto = '$puerto_nombre';";
            echo $query_capitan_3;
            $result_capitan_3 = $dbimp -> prepare($query_capitan_3);
            $result_capitan_3 -> execute();
            $coords = $result_capitan_3 -> fetchAll();
            $lat_puerto = $coords[0];
            $lon_puerto = $coords[1];
            echo '$coords';
            echo $coords;
            echo '$coords[0]';
            echo $coords[0];
            echo '$coords[0][0]';
            echo $coords[0][0];
            array_push($coords_puertos,[ "lat" => $lat_puerto, "long" => $lon_puerto]);
            array_push($marker_list2,[ "lat" => $lat_puerto, "long" => $lon_puerto]);
            echo $lat_puerto;
            echo $lon_puerto;
        }

    }
    
    ?>

<h2 class="title">Mensajes</h2>

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

                $lat = -33.5;
                $long = -70.5;
                foreach ($jsonData as $m) {
                    $date =  $m["date"];
                    $date_date = strtotime($date);
                    if ($date_date > $start_date && $end_date > $date_date && $userId == $m["sender"]) {
                        $lat =  $m["lat"];
                        $long =  $m["long"];
                        $mid =  $m["mid"];
                        $message =  $m["message"];
                        $receptant =  $m["receptant"];
                        $sender =  $m["sender"];
                        echo "<tr><td>$date</td><td>$lat</td><td>$long</td><td>$mid</td><td>$message</td><td>$receptant</td><td>$sender</td></tr>";
                        array_push($marker_list,[ "lat" => $lat, "long" => $long]);}

                    }
                

            ?>
        </tbody>    
</table>
</div>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
<script>
    var map = L.map('mapid').setView([<?php echo $lat ?>, <?php echo $long ?>], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
        });

    <?php foreach($marker_list as $marker) {
        echo
        'L.marker([' . $marker["lat"] . ',' . $marker["long"] . '], {icon: greenIcon}).addTo(map);';
    }
        foreach($marker_list2 as $marker) {

            echo
            'L.marker([' . $marker["lat"] . ',' . $marker["long"] . ']).addTo(map);';
        }
    
    ?>
</script>
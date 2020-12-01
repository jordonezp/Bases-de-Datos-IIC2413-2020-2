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
// echo $response;

// $json = json_decode($response);
// echo $json;
$jsonData = json_decode($response, JSON_INVALID_UTF8_IGNORE);
// echo $jsonData;
// echo '<pre>';
// var_dump($jsonData);
// echo '</pre>';

// foreach ($jsonData as $m) {
//     $rec = $m["receptant"];
//     if ($rec === $usuario_id) {
//         echo 
//     }
//     echo "\n m[0]: $m[0]";
//     echo "\n\n m['date']: ";
//     echo $m["date"];
// }

?>

<?php
        foreach ($jsonData as $m) {
            $rec = $m["receptant"];
            echo $rec;
            echo "<br>";
            echo $m["date"];
            echo "<br>";
            if ("$rec" === $usuario_id) {
                echo "True!!\n\n";
                echo "<tr>";
                echo $m["date"];
                // foreach ($m as $d) {
                //     echo "<td>";
                //     echo $d;
                //     echo "</td>";
                // }
                // echo "<td>$m['date']</td>";
                // echo "<td>$m['lat']</td>";
                // echo "<td>$m['long']</td>";
                // echo "<td>$m['mid']</td>";
                // echo "<td>$m['message']</td>";
                // echo "<td>$m['receptant']</td>";
                // echo "<td>$m['sender']</td>";
                echo "</tr>";
            }
            // echo "\n m[0]: $m[0]";
            // echo "\n\n m['date']: ";
            // echo $m["date"];
        }
        // foreach ($tabla as $fila) {
        //     echo "<tr> <td> <a href='consultas/consulta_puertos.php?pid=$fila[0]&name=$fila[1]'> $fila[1] </a> </td> </tr>";
        // }
    ?>

<table>
    <tr>
        <th>date</th>
        <th>lat</th>
        <th>long</th>
        <th>message</th>
        <th>mid</th>
        <th>receptant</th>
        <th>sender</th>
    </tr>

    <?php
        foreach ($jsonData as $m) {
            $rec = $m["receptant"];
            // echo $rec;
            // echo "<br>";
            // echo $m["date"];
            // echo "<br>";
            if ("$rec" === $usuario_id) {
                // echo "True!!\n\n";
                echo "<tr>";
                // echo $m["date"];
                // foreach ($m as $d) {
                //     echo "<td>";
                //     echo $d;
                //     echo "</td>";
                // }
                echo "<td>$m['date']</td>";
                echo "<td>$m['lat']</td>";
                echo "<td>$m['long']</td>";
                echo "<td>$m['mid']</td>";
                echo "<td>$m['message']</td>";
                echo "<td>$m['receptant']</td>";
                echo "<td>$m['sender']</td>";
                echo "</tr>";
            }
            // echo "\n m[0]: $m[0]";
            // echo "\n\n m['date']: ";
            // echo $m["date"];
        }
        // foreach ($tabla as $fila) {
        //     echo "<tr> <td> <a href='consultas/consulta_puertos.php?pid=$fila[0]&name=$fila[1]'> $fila[1] </a> </td> </tr>";
        // }
    ?>

</table>

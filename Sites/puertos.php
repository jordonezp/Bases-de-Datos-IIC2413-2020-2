<?php
require('./config/conection.php');
$query = "SELECT DISTINCT nnombre FROM naviera;";
$result = $dbimp -> prepare($query);
$result -> execute();
$facilities = $result -> fetchAll();
?>

<h1>Puertos</h1>
<br>

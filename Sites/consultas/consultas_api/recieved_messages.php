<?php session_start();?>
<?php include('../../templates/header.html');   ?>
<?php include('../../navbar.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<?php

require('../../config/conection.php');

$pid = $_GET["pid"];
$name = $_GET["name"];

?>

<?php
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

    echo sendGet($url);
?>

<?php session_start();?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<?php include('../navbar.php'); ?>
<?php include('../templates/header.html');   ?>

$old = $_POST["old"];
$new = $_POST["new"];
$pas = $_POST["pas"];

echo $pas;
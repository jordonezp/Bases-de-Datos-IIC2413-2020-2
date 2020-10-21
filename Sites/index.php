<?php
session_start();

if (!isset($_SESSION['name']))
{
  $_SESSION['name'] = "";
  $_SESSION['pasaporte'] = "";
}

echo $_SESSION['name'];
?>
<?php include('templates/header.html');   ?>
<?php include('navbar.php'); ?>

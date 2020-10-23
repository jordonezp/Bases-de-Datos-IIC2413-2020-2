<?php session_start();
$_SESSION["pasaporte"] = "";
$_SESSION["clave"] = "";
?>
<?php include('templates/header.html');   ?>
<?php include('navbar.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">

<div class="container is-max-desktop">
  <h2 class="title">Log-Out Succesfull</h2>
</div>

<?php include('../templates/footer.html'); ?>
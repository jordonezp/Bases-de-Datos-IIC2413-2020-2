<?php
session_start();

if (!isset($_SESSION['name']))
{
  $_SESSION['name'] = "";
  $_SESSION['pasaporte'] = "";
}
?>
<?php include('templates/header.html');   ?>
<?php include('navbar.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
<br/><br/><br/>


<div class="container is-max-desktop">

  <h2 class="title">Consulta Navieras</h2>

  <form align="center" action="navieras.php" method="post">
    <br/><br/>
    <input class="button is-link" type="submit" value="Buscar">
  </form>
</div>

<div class="container is-max-desktop">

  <h2 class="title">Consulta Puertos</h2>

  <form align="center" action="puertos.php" method="post">
    <br/><br/>
    <input class="button is-link" type="submit" value="Buscar">
  </form>


</div>

<?php 
$json = file_get_contents('../Entrega4/datos/usuarios.json');
$data = json_decode($json, true);
foreach($data as $row){
  $id = $row['id'];
  $name = $row['name'];
  $age = $row['age'];
  $desription = $row['description'];
  $sql = "INSERT INTO usuarios_json ('id','name', 'age', 'description') 
  VALUES ($id, $name, $age, $description)";
  echo ($id);
}
echo "listo";
  

?>

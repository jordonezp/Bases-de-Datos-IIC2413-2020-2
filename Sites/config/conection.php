<?php
  try {
    #Pide las variables para conectarse a la base de datos.
    require('dataimp.php');
    require('datap.php');
    # Se crea la instancia de PDO
    $dbimp = new PDO("pgsql:dbname=$databaseNam eimp;host=localhost;port=5432;user=$userimp;password=$passwordimp");
    $dbp = new PDO("pgsql:dbname=$databaseNamep;host=localhost;port=5432;user=$userp;password=$passwordp");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>
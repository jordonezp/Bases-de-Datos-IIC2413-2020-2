Hello World!

<?php
    require('./config/conection.php');

    $query = "SELECT * FROM facilities;";
    $result = $db -> prepare($query);
    $result -> execute();
    $facilities = $result -> fetchAll();
?>
<?php
    foreach ($facilities as $f) {
        echo $f;
    }
?>
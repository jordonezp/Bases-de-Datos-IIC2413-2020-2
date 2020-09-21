<?php
    require('../config/conection.php');

    $input = $_POST["input"];
    // $query = "SELECT * FROM facilities;";
    $result = $db -> prepare($input);
    $result -> execute();
    $facilities = $result -> fetchAll();
?>

<h1>Consultas Generales</h1>
<h3>input: <?php echo $input?></h3>
<table>
    <!-- <tr>
        <th>fid</th>
        <th>type</th>
        <th>capacity</th>
        <th>boss_rut</th>
        <th>pid</th>
    </tr> -->
<?php
    foreach ($facilities as $f) {
        $row = "<tr>";
        // echo "<tr>";
        foreach ($f as $f_i){
            $row += "<td>$f_i</td>";
        }
        $row = "</tr>";
        echo $row;
        // echo "</tr>";
    }
?>
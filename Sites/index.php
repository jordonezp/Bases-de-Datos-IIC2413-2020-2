Hello World!

<?php
    require('./config/conection.php');

    $query = "SELECT * FROM facilities;";
    $result = $db -> prepare($query);
    $result -> execute();
    $facilities = $result -> fetchAll();
?>
<table>
    <tr>
        <th>fid</th>
        <th>type</th>
        <th>capacity</th>
        <th>boss_rut</th>
        <th>pid</th>
    </tr>
<?php
    foreach ($facilities as $f) {
        echo 
        "<tr>
            <td>$f[0]</td>
            <td>$f[1]</td>
            <td>$f[2]</td>
            <td>$f[3]</td>
            <td>$f[4]</td>
        </tr>"
        ;
    }
?>
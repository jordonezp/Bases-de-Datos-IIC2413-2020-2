<?php


$items = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", 
            "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
            "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7",
            "8", "9", "0"];


$query_cap = "SELECT pasaporte, capitan, penombre, edad, genero, nacionalidad FROM personal";
$result = $dbp -> prepare($query);
$result -> execute();
$caps = $result -> fetchAll();

foreach ($caps as $cap) {
    if ($cap[1] == "t") {
        $query_all = "SELECT * FROM usuarios;";
        $result_all = $dbp -> prepare($query_all);
        $result_all -> execute();
        $all = $result_all -> fetchAll();
        $last = end($all);
        $uid = (int)$last[0] + 1;
        
        
        $pass = $items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)];
        $edad2 = (int)$cap[3];

        $sql = "INSERT INTO usuarios(uid, nombre, pasaporte, nacionalidad, password, edad, sexo) VALUES (?,?,?,?,?,?,?)";
        $stmt = $dbp -> prepare($sql);
        $stmt -> execute([$uid, $cap[2], $cap[0], $cap[5], $pass, $edad2, $cap[4]]);
    }
}





$query_boss = "SELECT pasaporte, capitan, penombre, edad, genero, nacionalidad FROM personal";
$result = $dbimp -> prepare($query);
$result -> execute();
$bosses = $result -> fetchAll();

foreach ($bosses as $boss) {
    $query_all = "SELECT * FROM usuarios;";
    $result_all = $dbp -> prepare($query_all);
    $result_all -> execute();
    $all = $result_all -> fetchAll();
    $last = end($all);
    $uid = (int)$last[0] + 1;
    
    
    $pass = $items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)].$items[rand(0, count($items) - 1)];
    $edad2 = (int)$cap[3];

    $sql = "INSERT INTO usuarios(uid, nombre, pasaporte, nacionalidad, password, edad, sexo) VALUES (?,?,?,?,?,?,?)";
    $stmt = $dbp -> prepare($sql);
    $stmt -> execute([$uid, $cap[2], $cap[0], $cap[5], $pass, $edad2, $cap[4]]);


}






?>
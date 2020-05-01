<?php

//Get current table state
$sql_get_tiles = "SELECT * FROM `tiles`";
$sql_get_tiles_result = mysqli_query($conn, $sql_get_tiles);

while($row = mysqli_fetch_array($sql_get_tiles_result, MYSQLI_ASSOC)){
    $results[] = $row;
}

mysqli_free_result($sql_get_tiles_result);

foreach ($results as $result){
    $tiles[$result["x_coord"]][$result["y_coord"]] = $result["char_type"];
}

?>
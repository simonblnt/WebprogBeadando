<?php
    require_once 'config/config.php';

	//SQL command
    $sql_get_tiles = "SELECT * FROM `tiles`";

	//Query
    $sql_get_tiles_result = mysqli_query($conn, $sql_get_tiles);
    
  

	//Fetch query response to an array
    while($row = mysqli_fetch_array($sql_get_tiles_result, MYSQLI_ASSOC)){
		$results[] = $row;
	}

	//Deconstruct mysqli result
	mysqli_free_result($sql_get_tiles_result);

	//Save tiles to the tiles array
	foreach ($results as $result){
		$tiles[$result["x_coord"]][$result["y_coord"]] = $result["char_type"];
	}/* 
	$log->lwrite("Size: ".$size); */
?>
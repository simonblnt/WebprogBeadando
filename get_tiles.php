<?php
    require_once 'config.php';

	//Init
	$results = array();
	$tiles = array();
	$x_won = false;
	$o_won = false;

	//SQL command
    $sql_get_tiles = "SELECT * FROM `tiles`";

	//Query
    $sql_get_tiles_result = mysqli_query($conn, $sql_get_tiles);
    
  

	//Fetch query response to an array
    while($row = mysqli_fetch_array($sql_get_tiles_result, MYSQLI_ASSOC)){
		$results[] = $row;
	}

	//Deconstruct mysqli
	mysqli_free_result($sql_get_tiles_result);
	mysqli_close($conn);
     

	//Save tiles to the tiles array
	foreach ($results as $result){
		$tiles[$result["x_coord"]][$result["y_coord"]] = $result["char_type"];
	}
	$log->lwrite("Size: ".$size);
	
	///Check if somebody has won
	for ($i = 0; $i < $size; $i++){
		$h_count_x = 0;
		$h_count_o = 0;
		for ($j = 0; $j < $size; $j++){
			//Check horizontal Xs
			if (strcmp($tiles[$i][$j], "X") == 0){
				$h_count_x++;
			}
			//Check horizontal Os
			if (strcmp($tiles[$i][$j], "O") == 0){
				$h_count_o++;
			}
		}
		if ($h_count_x == 5){ //Check if there are N number of Xs horizontally
			$x_won = true;
		}elseif ($h_count_o == 5) { //Check if there are N number of Os horizontally
			$o_won = true;
		}
	}
	/* for ($i = 0; $i < $size; $i++){
		$v_count_x = 0;
		$v_count_o = 0;
		
		for ($j = 0; $j < $size; $j++){
			
		}
		if ($v_count_x == 5){ //Check if there are N number of Xs horizontally
			$x_won = true;
		}elseif ($v_count_o == 5) { //Check if there are N number of Os horizontally
			$o_won = true;
		}
	} */
	//Check vertical lines




	//Draw game table
    $game_table="";
	$game_table.="
	<div class='table-wrapper'>";
	if ($x_won){
		$game_table.="<p>X has won the game.</p>";
	}elseif ($o_won) {
		$game_table.="<p>O has won the game.</p>";
	}

	$game_table.="
		<table class='game-table noselect'>";
			for ($i = 0; $i < $size; $i++)
			{
				$game_table.="
						<tr>
					";
				for ($j = 0; $j< $size; $j++)
				{
					$game_table.="
						<td>".$tiles[$i][$j]."</td>
					";
				}
				$game_table.="
						</tr>
					";
			}
	$game_table.="
		</table>
    </div>";
    
    echo $game_table;

?>
<?php
	//Get the currently active game
	$sql_get_active_game = "SELECT * FROM games WHERE active = 1 LIMIT 1";
	$active_game = mysqli_query($conn, $sql_get_active_game);

	if (mysqli_num_rows($active_game) > 0) {
		while($row = mysqli_fetch_assoc($active_game)) {
			$game_id = $row["id"];
			$player1_id = $row["player1_id"];
			$player2_id = $row["player2_id"];
			$player_on_turn_id = $row["player_on_turn"];
			$winner_id = $row["winner_id"];
		}
	} else {
		echo "0 results";
	}

	//Get active players
	$sql_get_player_1 = "SELECT * FROM players WHERE id = ".$player1_id." LIMIT 1";
	$player1 = mysqli_query($conn, $sql_get_player_1);

	if (mysqli_num_rows($player1) > 0) {
		while($row = mysqli_fetch_assoc($player1)) {
			$player1_id = $row["id"];
			$player1_name = $row["player_name"];
		}
	} else {
		echo "0 results";
	}

	$sql_get_player_2 = "SELECT * FROM players WHERE id = ".$player2_id." LIMIT 1";
	$player2 = mysqli_query($conn, $sql_get_player_2);

	if (mysqli_num_rows($player2) > 0) {
		while($row = mysqli_fetch_assoc($player2)) {
			$player2_id = $row["id"];
			$player2_name = $row["player_name"];
		}
	} else {
		echo "0 results";
	}

	//Check if either of the active players has won
	if ($winner_id == $player1_id) {
		$p1_won = true;
		$p2_won = false;
		$p1_on_turn = false;
		$p2_on_turn = false;
	} elseif ($winner_id == $player2_id) {
		$p1_won = false;
		$p2_won = true;
		$p1_on_turn = false;
		$p2_on_turn = false;
	} elseif ($player_on_turn_id == 1) {
		$p1_won = false;
		$p2_won = false;
		$p1_on_turn = true;
		$p2_on_turn = false;
	} elseif ($player_on_turn_id == 2) {
		$p1_won = false;
		$p2_won = false;
		$p1_on_turn = false;
		$p2_on_turn = true;
	} else {
		echo "Unlikely error";
	}

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
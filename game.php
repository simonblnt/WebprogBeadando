<?php
    require_once 'includes/config.php';

	//Init
	$results = array();
	$tiles = array();
	$player1_id;
	$player1_name;
	$player2_id;
	$player2_name;
	$p1_won;
	$p2_won;
	$p1_on_turn;
	$p2_on_turn;
	$notification = "";
	$game_table = "";

	require 'includes/get_game_state.php';
	
	$notification.="
	<div class='table-wrapper'>";
	//Write notification
	if ($p1_won){
		$notification.="<p class='game-notification'>".$player1_name." has won the game.</p>";
	}elseif ($p2_won) {
		$notification.="<p class='game-notification'>".$player2_name." has won the game.</p>";
	}elseif ($p1_on_turn == true) {
		$notification.="<p class='game-notification'>".$player1_name."'s turn</p>";
	}elseif ($p2_on_turn == true) {
		$notification.="<p class='game-notification'>".$player2_name."'s turn</p>";
	}
	else{
		$notification.="<p class='game-notification'></p>";
	}

	//Draw game table
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
	
	echo $notification;
	echo $game_table;
	


?>
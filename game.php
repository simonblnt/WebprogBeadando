<?php
    require_once 'config/config.php';

	//Init
	$results = array();
	$tiles = array();
	$x_won = false;
	$o_won = false;
	$p1_turn = true;
	$p2_turn = false;
	$notification ="";
	$game_table="";

	require 'sql/get_tiles.php';
	
	require 'sql/check_win.php';

	
	
	$notification.="
	<div class='table-wrapper'>";
	//Write notification
	if ($x_won){
		$notification.="<p class='game-notification'>X has won the game.</p>";
	}elseif ($o_won) {
		$notification.="<p class='game-notification'>O has won the game.</p>";
	}elseif ($p1_turn = true) {
		$notification.="<p class='game-notification'>Player 1's turn</p>";
	}elseif ($p2_turn = true) {
		$notification.="<p class='game-notification'>Player 2's turn</p>";
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
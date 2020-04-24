<?php
    require 'db_conn.php';

    $sql_get_tiles = "SELECT * FROM `tiles`";

    $sql_get_tiles_result = mysqli_query($conn, $sql_get_tiles);
    

    $tiles = array();

	$results = array();


    while($row = mysqli_fetch_array($sql_get_tiles_result, MYSQLI_ASSOC)){
    	$results[] = $row;
	}

	mysqli_free_result($sql_get_tiles_result);
	mysqli_close($conn);
     


	foreach ($results as $result){
        $tiles[$result["x_coord"]][$result["y_coord"]] = $result["char_type"];
    }

    $game_table="";
	$game_table.="
	<div class='table-wrapper'>
		<table class='game-table noselect'>";
			for ($i = 0; $i<$n; $i++)
			{
				$game_table.="
						<tr>
					";
				for ($j = 0; $j<$n; $j++)
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
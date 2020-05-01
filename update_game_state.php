<?php
    require_once 'includes/config.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST["make_turn"]))
    {    
        #region Init
        $size = 5;
        $x_coord;
        $y_coord;
        $game_id;
        $player1_id;
        $player2_id;
        $player_on_turn_id;
        $player_on_turn;
        $tile_id;
        $x_won = false;
	    $o_won = false;
        
        if(isset($_POST["x_coord"])){
            $x_coord = $_POST["x_coord"]-1;
        }else{
            die("No X coordinate specified!");
        }
        if(isset($_POST["y_coord"])){
            $y_coord = $_POST["y_coord"]-1;
        }else{
            die("No Y coordinate specified!");
        }
        if(isset($_POST["char_type"])){
            $char_type = $_POST["char_type"];
        }else{
            die("No character type specified!");
        }
        #endregion


        #region Update Game

        //Update Tiles table
        $sql_add_char_to_tile = "UPDATE `tiles` SET `char_type`='".$char_type."'
                                    WHERE `x_coord`=".$x_coord." AND `y_coord`=".$y_coord;

        if (mysqli_query($conn, $sql_add_char_to_tile)) {
            $log->lwrite("Tile updated successfully");
        } else {
            $log->lwrite("Tile update error: ".mysqli_error($conn));
        }

        //Get the updated tile's id
        $sql_get_updated_tile_id = "SELECT id FROM `tiles` WHERE `x_coord`=".$x_coord." AND `y_coord`=".$y_coord;"";
        $updated_tile = mysqli_query($conn, $sql_get_updated_tile_id);

        if (mysqli_num_rows($updated_tile) > 0) {
            while($row = mysqli_fetch_assoc($updated_tile)) {
                $tile_id = $row["id"];
            }
        } else {
            echo "0 results";
        }

        //Get the currently active game
        $sql_get_active_game = "SELECT * FROM games WHERE active = 1 LIMIT 1";
        $active_game = mysqli_query($conn, $sql_get_active_game);

        if (mysqli_num_rows($active_game) > 0) {
            while($row = mysqli_fetch_assoc($active_game)) {
                $game_id = $row["id"];
                $player1_id = $row["player1_id"];
                $player2_id = $row["player2_id"];
                $player_on_turn = $row["player_on_turn"];
                if ($player_on_turn == 1) {
                    $player_on_turn_id = $player1_id;
                } elseif ($player_on_turn == 2) {
                    $player_on_turn_id = $player2_id;
                }
            }
        } else {
            echo "0 results";
        }

        //Use the fetched data to save the turn
        $sql_save_turn = "INSERT INTO `turns`(`game_id`, `player_id`, `tile_id`) VALUES (".$game_id.",".$player_on_turn_id.",".$tile_id.")";
        if (mysqli_query($conn, $sql_save_turn)) {
            $log->lwrite("Turn saved successfully");
        } else {
            $log->lwrite("Turn save error: " . $sql . "<br>" . mysqli_error($conn));
        }

        //Check if somebody has won
        require 'includes/check_win.php';

        // If somebody won, update the game table
        if ($x_won || $y_won) {
            // Set player_on_turn -> null
            $sql_remove_player_on_turn = "UPDATE `games` SET `player_on_turn`= NULL WHERE `id`= ".$game_id;

            if (mysqli_query($conn, $sql_remove_player_on_turn)) {
                $log->lwrite("Player removed from turn successfully");
            } else {
                $log->lwrite("Player removed from turn error: " . $sql . "<br>" . mysqli_error($conn));
            }

            // Set winner_id
            $sql_set_winner_id = "UPDATE `games` SET `winner_id`= ".$player_on_turn_id." WHERE `id`= ".$game_id;

            if (mysqli_query($conn, $sql_set_winner_id)) {
                $log->lwrite("Winner set successfully");
            } else {
                $log->lwrite("Winner set error: " . $sql . "<br>" . mysqli_error($conn));
            }
        } else {
            // If nobody won, change the player on turn
            $sql_change_player_on_turn = "";
            if ($player_on_turn == 1) {
                $sql_change_player_on_turn = "UPDATE `games` SET `player_on_turn`=2  WHERE `id`= ".$game_id;
            } elseif ($player_on_turn == 2) {
                $sql_change_player_on_turn = "UPDATE `games` SET `player_on_turn`=1  WHERE `id`= ".$game_id;
            }
            
            if (mysqli_query($conn, $sql_change_player_on_turn)) {
                $log->lwrite("Player changed successfully");
            } else {
                $log->lwrite("Player change error: " . $sql . "<br>" . mysqli_error($conn));
            }
        }

        #endregion

    } elseif(isset($_POST["new_game"])) {
        //End all active games
        $sql_end_active_game = "UPDATE `games` SET `active`= 0 WHERE `active`= 1";

        if (mysqli_query($conn, $sql_end_active_game)) {
            $log->lwrite("Game ended successfully");
        } else {
            $log->lwrite("Game ending error: " . $sql . "<br>" . mysqli_error($conn));
        }

        //Start a new game
        $sql_create_new_game = "INSERT INTO `games`(`player1_id`, `player2_id`, `player_on_turn`, `active`) VALUES (36, 35, 1, 1)";

        if (mysqli_query($conn, $sql_create_new_game)) {
            $log->lwrite("Game created successfully");
        } else {
            $log->lwrite("Game creation error: " . $sql . "<br>" . mysqli_error($conn));
        }


        //Reset current table state to empty
        $sql_reset_table = "UPDATE `tiles` SET `char_type`=' '";

        if (mysqli_query($conn, $sql_reset_table)) {
            $log->lwrite("Table reset successful");
        } else {
            $log->lwrite("Table reset error: ".mysqli_error($conn));
        }
    }

    
}


header("location: index.php");

?> 
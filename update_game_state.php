<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    $log->lwrite("session starts in update");
    session_start();
}
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
        $draw = false;
        
        if(isset($_POST["x_coord"])){
            $x_coord = $_POST["x_coord"]-1;
        }else{
            die("No X coordinate specified!");
        }
        if(isset($_POST["y_coord"]) ){
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
            /* $log->lwrite("Tile updated successfully"); */
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

        //Get current table state
        require 'includes/get_table_state.php';

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
            /* $log->lwrite("Turn saved successfully"); */
        } else {
            $log->lwrite("Turn save error: " . $sql . "<br>" . mysqli_error($conn));
        }

        // Increment player's turn count
        $sql_increment_turn_count = NULL;
        if ($player_on_turn == 1) {
            $sql_increment_turn_count = "UPDATE `games` SET `player1_turns`= `player1_turns`+1 WHERE `id`= ".$game_id;
        } elseif ($player_on_turn == 2) {
            $sql_increment_turn_count = "UPDATE `games` SET `player2_turns`= `player2_turns`+1 WHERE `id`= ".$game_id;
        }
       
        if ($sql_increment_turn_count != NULL)
        {
            if (mysqli_query($conn, $sql_increment_turn_count)) {
                /* $log->lwrite("Turn count incremented successfully, gameid: ".$game_id); */
            } else {
                $log->lwrite("Turn count increment error: " . $sql . "<br>" . mysqli_error($conn));
            }
        }
        

        //Check if somebody has won
        require 'includes/check_win.php';

        //Check if game is a draw
        require 'includes/check_draw.php';

        // If somebody won, update the game table
        if ($x_won || $y_won) {
            //Set current player as winner
            $winner_id = $player_on_turn_id;

            // Set player_on_turn -> null
            $sql_remove_player_on_turn = "UPDATE `games` SET `player_on_turn`= NULL WHERE `id`= ".$game_id;

            if (mysqli_query($conn, $sql_remove_player_on_turn)) {
                /* $log->lwrite("Player removed from turn successfully"); */
            } else {
                $log->lwrite("Player removed from turn error: " . $sql . "<br>" . mysqli_error($conn));
            }

            // Set winner_id
            $sql_set_winner_id = "UPDATE `games` SET `winner_id`= ".$winner_id." WHERE `id`= ".$game_id;

            if (mysqli_query($conn, $sql_set_winner_id)) {
                /* $log->lwrite("Winner set successfully"); */
            } else {
                $log->lwrite("Winner set error: " . $sql . "<br>" . mysqli_error($conn));
            }

            // Increment player's win count
            $sql_increment_win_count = "UPDATE `players` SET `wins`= `wins`+1 WHERE `id`= ".$winner_id;

            if (mysqli_query($conn, $sql_increment_win_count)) {
                /* $log->lwrite("Winner set successfully"); */
            } else {
                $log->lwrite("Winner increment error: " . $sql . "<br>" . mysqli_error($conn));
            }

            //Set gamestate session variable to finished
            $_SESSION["gameState"] = "FINISHED";
            $log->lwrite("Session varible game state value: ".$_SESSION["gameState"]);



        } elseif ($draw == true) {
            //Setting winner_id to -1, this indicates draw
            $winner_id = -1;

            // Set player_on_turn -> null
            $sql_remove_player_on_turn = "UPDATE `games` SET `player_on_turn`= NULL WHERE `id`= ".$game_id;

            if (mysqli_query($conn, $sql_remove_player_on_turn)) {
                /* $log->lwrite("Player removed from turn successfully"); */
            } else {
                $log->lwrite("Player removed from turn error: " . $sql . "<br>" . mysqli_error($conn));
            }

            // Set winner_id
            $sql_set_winner_id = "UPDATE `games` SET `winner_id`= ".$winner_id." WHERE `id`= ".$game_id;

            if (mysqli_query($conn, $sql_set_winner_id)) {
                /* $log->lwrite("Winner set successfully"); */
            } else {
                $log->lwrite("Winner set error: " . $sql . "<br>" . mysqli_error($conn));
            }

            //Set gamestate session variable to finished
            $_SESSION["gameState"] = "FINISHED";
            $log->lwrite("Session varible game state value: ".$_SESSION["gameState"]);
            
        } else {
            // If nobody won, change the player on turn
            $sql_change_player_on_turn = "";
            if ($player_on_turn == 1) {
                $sql_change_player_on_turn = "UPDATE `games` SET `player_on_turn`=2  WHERE `id`= ".$game_id;
            } elseif ($player_on_turn == 2) {
                $sql_change_player_on_turn = "UPDATE `games` SET `player_on_turn`=1  WHERE `id`= ".$game_id;
            }
            
            if (mysqli_query($conn, $sql_change_player_on_turn)) {
                /* $log->lwrite("Player changed successfully"); */
            } else {
                $log->lwrite("Player change error: " . $sql . "<br>" . mysqli_error($conn));
            }

            //Set gamestate session variable to ongoing
            $_SESSION["gameState"] = "ONGOING";
            $log->lwrite("Session varible game state value: ".$_SESSION["gameState"]);
        }
       
        #endregion
    }



    header('Location: index.php?v='.time());
    exit;
}




?> 
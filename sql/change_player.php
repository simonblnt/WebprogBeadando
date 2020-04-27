<?php
    require_once 'config/config.php';




    //!!Later filter this so that it only returns the 2 active players!!


    $sql_change_player = "UPDATE `players` SET `on_turn`= 2 WHERE `on_turn` = 1;";
    $sql_change_player .= "UPDATE `players` SET `on_turn`= 1 WHERE `on_turn` = 0;";
    $sql_change_player .= "UPDATE `players` SET `on_turn`= 0 WHERE `on_turn` = 2";

    

    if ($conn->multi_query($sql_change_player) === TRUE) {
        echo "Player turn changed successfully";
    } else {
        echo "Error updating player: " . $conn->error;
    }
?>
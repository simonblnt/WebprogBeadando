<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    $log->lwrite("session starts in restart");
    session_start();
}
require_once 'includes/config.php';

if(isset($_POST["new_game"])) {
    //End all active games
    $sql_end_active_game = "UPDATE `games` SET `active`= 0 WHERE `active`= 1";

    if (mysqli_query($conn, $sql_end_active_game)) {
        /* $log->lwrite("Game ended successfully"); */
    } else {
        $log->lwrite("Game ending error: " . $sql . "<br>" . mysqli_error($conn));
    }

    //Start a new game
    $sql_create_new_game = "INSERT INTO `games`(`player1_id`, `player2_id`, `player_on_turn`, `active`) VALUES (36, 35, 1, 1)";

    if (mysqli_query($conn, $sql_create_new_game)) {
        /* $log->lwrite("Game created successfully"); */
    } else {
        $log->lwrite("Game creation error: " . $sql . "<br>" . mysqli_error($conn));
    }


    //Reset current table state to empty
    $sql_reset_table = "UPDATE `tiles` SET `char_type`=' '";

    if (mysqli_query($conn, $sql_reset_table)) {
        /* $log->lwrite("Table reset successful"); */
    } else {
        $log->lwrite("Table reset error: ".mysqli_error($conn));
    }

    //Set gamestate session variable to true
    $_SESSION["gameState"] = "ONGOING";
    $log->lwrite("Session varible game state value: ".$_SESSION["gameState"]);
}

header('Location: index.php?v='.time());
exit;
?>
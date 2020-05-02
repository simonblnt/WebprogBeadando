<?php
require_once 'includes/config.php';



//Get Games
$sql_get_games = "SELECT * FROM `games`";
$sql_get_games_result = mysqli_query($conn, $sql_get_games);

while($row = mysqli_fetch_array($sql_get_games_result, MYSQLI_ASSOC)){
    $games[] = $row;
}

mysqli_free_result($sql_get_games_result);

//Get Players
$sql_get_players = "SELECT * FROM `players`";
$sql_get_players_result = mysqli_query($conn, $sql_get_players);

while($row = mysqli_fetch_array($sql_get_players_result, MYSQLI_ASSOC)){
    $players[] = $row;
}
/* $log->lwrite("in get count($players): ".count($players)); */
mysqli_free_result($sql_get_players_result);







//Get Turns
$sql_get_turns = "SELECT * FROM `turns`";
$sql_get_turns_result = mysqli_query($conn, $sql_get_turns);

while($row = mysqli_fetch_array($sql_get_turns_result, MYSQLI_ASSOC)){
    $turns[] = $row;
}

mysqli_free_result($sql_get_turns_result);




//Number of players


?>
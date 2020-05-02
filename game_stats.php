<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/WebprogBeadando/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Nova Flat' rel='stylesheet'>
	<script src="js/application.js"></script>
</head>

<body>
<div class='game-wrapper'>

    
    <?php
        require 'get_high_scores.php';

        require 'game_stats_bar.php';
        
        $game_stats_table = "";
        $game_stats_table .= "
        <table>
            <thead>
                <tr>
                    <th>Player 1</th>
                    <th>Player 2</th>
                    <th>Winner</th>
                    <th>Turns to win</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>";

            /* $log->lwrite("count($players): ".count($players)); */
            for ($i = 0; $i < count($games); $i++) {

                /* $log->lwrite("games[i][player1id]: ".$games[$i]["player1_id"]);
                $log->lwrite("games[i][player2id]: ".$games[$i]["player2_id"]);
                 */

                $player1_name = "";
                $player2_name = "";
                $winner_name = "";
                $winner_turn_count = 0;
                //Search player names in player array
                foreach ($players as $player){
                    if ($player["id"] == $games[$i]["player1_id"]) {
                        $player1_name = $player["player_name"];
                    }
                    if ($player["id"] == $games[$i]["player2_id"]) {
                        $player2_name = $player["player_name"];
                    }
                    if ($player["id"] == $games[$i]["winner_id"]) {
                        $winner_name = $player["player_name"];
                    }
                }
                
                //Search for number of turns
                if ($games[$i]["player1_id"] == $games[$i]["winner_id"]) {
                    $winner_turn_count = $games[$i]["player1_turns"];
                } elseif ($games[$i]["player2_id"] == $games[$i]["winner_id"]) {
                    $winner_turn_count = $games[$i]["player2_turns"];
                }

                //Search for game date
                $date = $games[$i]["time_started"];


                //Add data to table variable
                $game_stats_table .= "
                <tr>
                    <td>".$player1_name."</td>
                    <td>".$player2_name."</td>
                    <td>".$winner_name."</td>
                    <td>".$winner_turn_count."</td>
                    <td>".$date."</td>
                </tr>";
            }

        $game_stats_table .= "</tbody>
        </table>";


        echo $game_stats_table;
    ?>



    


</div>
</body>
</html>
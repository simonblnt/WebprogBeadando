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

        require 'leaderboard_bar.php';
        
        $leaderboard_table = "";
        $leaderboard_table .= "
        <table>
            <thead>
                <tr>
                    <th>Player name</th>
                    <th>Number of wins</th>
                    <th>Average number of turns</th>
                    <th>Average number of turns in winning matches</th>
                </tr>
            </thead>

            <tbody>";

            /* $log->lwrite("count($players): ".count($players)); */

            foreach ($players as $player)
            {
                $win_count = 0;

                $all_turns_count = 0;
                $all_turns_sum = 0;

                $all_turns_in_wins_count = 0;
                $all_turns_in_wins_sum = 0;

                //Loop through all games
                foreach ($games as $game) {
                    //Only check games where the player won
                    if ($game["winner_id"] == $player["id"]) {
                        $win_count++;
                        //Check if the player was player 1 or 2
                        if ($player["id"] == $game["player1_id"]) {
                            //Add the correct turn count to the sum
                            $all_turns_in_wins_sum += $game["player1_turns"];
                            $all_turns_in_wins_count++;
                        } elseif ($player["id"] == $game["player1_id"]) {
                            $all_turns_in_wins_sum += $game["player2_turns"];
                            $all_turns_in_wins_count++;
                        }
                    } else {
                    //Check all games                    
                        //Check if the player was player 1 or 2
                        if ($player["id"] == $game["player1_id"]) {
                            //Add the correct turn count to the sum
                            $all_turns_sum += $game["player1_turns"];
                            $all_turns_count++;
                        } elseif ($player["id"] == $game["player1_id"]) {
                            $all_turns_sum += $game["player2_turns"];
                            $all_turns_count++;
                        }
                    }
                }

                if ($all_turns_count == 0) {
                    $avg_turns_all = 0;
                } else {
                    $avg_turns_all = $all_turns_sum/$all_turns_count;
                }
                if ($all_turns_count == 0) {
                    $avg_turns_in_wins = 0;
                } else {
                    $avg_turns_in_wins = $all_turns_in_wins_sum/$all_turns_in_wins_count;
                }
                
                



                $leaderboard_table .= "
                <tr>
                    <td>".$player["player_name"]."</td>
                    <td>".$win_count."</td>
                    <td>".$avg_turns_all."</td>
                    <td>".$avg_turns_in_wins."</td>
                </tr>";
            }

        $leaderboard_table .= "</tbody>
        </table>";


        echo $leaderboard_table;
    ?>



    


</div>
</body>
</html>
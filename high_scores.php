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


        
        echo "
        <table>
            <thead>
                <tr>
                    <th>Player name</th>
                    <th>Number of wins</th>
                    <th>Average number of turns</th>
                </tr>
            </thead>

            <tbody>";

            

        echo "</tbody>
        </table>";

    ?>



    


</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<script src="js/application.js"></script>
</head>

<body>
<div class='control-wrapper'>
    <form name="endGameForm" action='restart_game.php' method='POST' class='control bar'>
        <button type='submit' name='new_game' class='item btn'>Start New Game</button>		
    </form>

    <form name="highScoresForm" action='high_scores.php' method='GET' class='control bar'>
        <button type='submit' class='item btn'>High Scores</button>	
    </form>
</div>
</body>
</html>
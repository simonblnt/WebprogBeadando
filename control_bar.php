<!DOCTYPE html>
<html>
<head>
	<script src="js/application.js"></script>
</head>

<body>
<div class='control-wrapper'>
	<form name="controlForm" action='update_game_state.php' method='POST' onsubmit="return validateForm()" class='control bar'>
		<input type='text' id='x_coord' name='x_coord' class='item coordinate' autocomplete='off' value=''>
		<input type='text' id='y_coord' name='y_coord' class='item coordinate' autocomplete='off' value=''>
		<select id='char_type' name='char_type' class='item char-select'>
			<option value='X' class='char-item'>X</option>
			<option value='O' class='char-item'>O</option>
		</select>
		<button type='submit' name='make_turn' class='item btn'>Submit</button>
	</form>
	<form name="restartForm" action='restart_game.php' method="POST" onsubmit="return confirmRestart()" class="control restart">
		<button type='submit' name='new_game' class='item icn'><img class='reset-icn' src='https://img.icons8.com/color/48/000000/restart--v1.png'/></button>		
	</form>
</div>
</body>
</html>
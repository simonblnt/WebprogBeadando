<?php
    require_once 'config/config.php';

	$control_bar="";
	$control_bar.="
	<div class='control-wrapper'>
	<form action='sql/update_tile.php' method='POST' class='control'>
		<input type='text' id='x_coord' name='x_coord' class='item coordinate' autocomplete='off' value=''>
		<input type='text' id='y_coord' name='y_coord' class='item coordinate' autocomplete='off' value=''>
		<select id='char_type' name='char_type' class='item char-select'>
			<option value='X' class='char-item'>X</option>
			<option value='O' class='char-item'>O</option>
		</select>
		<button type='submit' name='put_char' class='item btn'>Submit</button>
		<button type='submit' name='reset_table' class='item icn'><img class='reset-icn' src='https://img.icons8.com/color/48/000000/restart--v1.png'/></button>
		
	</form>
	</div>
	";

	echo $control_bar;

?>
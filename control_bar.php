<?php
    require 'db_conn.php';

    $n=5;

	$control_bar="";
	$control_bar.="
	<div class='control-wrapper'>
	<form action='update_tile.php' method='POST' class='control'>
		<input type='text' id='x_coord' name='x_coord' class='item coordinate' autocomplete='off' value=''>
		<input type='text' id='y_coord' name='y_coord' class='item coordinate' autocomplete='off' value=''>
		<select id='char_type' name='char_type' class='item char-select'>
			<option value='X' class='char-item'>X</option>
			<option value='O' class='char-item'>O</option>
		</select>
		<input type='submit' class='item btn' value='Submit'>
	</form>
	</div>
	";

	echo $control_bar;

?>
<?php

    function init_db(){
        require_once 'init_db.php';
    }

    function draw_game(){
        echo "<div class='control-wrapper'>
        <form action='' class='control'>
            <input type='text' id='x_coord' name='x_coord' class='item coordinate' value=''>
            <input type='text' id='y_coord' name='y_coord' class='item coordinate' value=''>
            <select name='' id='char_type' class='item char-select'></select>
            <input type='submit' class='item btn' value='Submit'>
        </form>
      </div>
      <div class='table-wrapper'>
            <table class='game-table'>
                <tr> 
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                </tr>
                <tr> 
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                </tr>
                <tr> 
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                </tr>
                <tr> 
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                </tr>
                <tr> 
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                </tr>
            </table>
      </div>";
    }

    init_db();
    draw_game();
?>
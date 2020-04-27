<?php
    require_once 'config/config.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST["put_char"]))
    {    
        $x_coord;
        $y_coord;
        if(isset($_POST["x_coord"])){
            $x_coord = $_POST["x_coord"]-1;
        }else{
            die("No X coordinate specified!");
        }
        if(isset($_POST["y_coord"])){
            $y_coord = $_POST["y_coord"]-1;
        }else{
            die("No Y coordinate specified!");
        }
        if(isset($_POST["char_type"])){
            $char_type = $_POST["char_type"];
        }else{
            die("No character type specified!");
        }

        $sql_add_char_to_tile = "UPDATE `tiles` SET `char_type`='".$char_type."'
                                    WHERE `x_coord`=".$x_coord." AND `y_coord`=".$y_coord;

        if (mysqli_query($conn, $sql_add_char_to_tile)) {
            $log->lwrite("Tile updated successfully");
        } else {
            $log->lwrite("Tile update error: ".mysqli_error($conn));
        }
    }elseif(isset($_POST["reset_table"])){
        $sql_reset_table = "UPDATE `tiles` SET `char_type`=' '";

        if (mysqli_query($conn, $sql_reset_table)) {
            $log->lwrite("Table reset successful");
        } else {
            $log->lwrite("Table reset error: ".mysqli_error($conn));
        }
    }
}


header("location: index.php");

?> 
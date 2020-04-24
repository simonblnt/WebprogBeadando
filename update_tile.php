<?php
    require_once 'config.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

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

    $sql_add_char_to_tile = "UPDATE `tiles` SET `char_type`='".$char_type."' WHERE `x_coord`=".$x_coord." AND `y_coord`=".$y_coord;

    if (mysqli_query($conn, $sql_add_char_to_tile)) {
        /* echo "Tile updated successfully"; */
    } else {
        /* echo "Error updating record: " . mysqli_error($conn); */
    }
}


header("location: index.php");

?> 
<?php
    $log->lwrite("checkwin table state utan");

    $empty_spaces = $size*$size;

    for ($i = 0; $i < $size; $i++){
        for ($j = 0; $j < $size; $j++){
            //Check horizontal Xs
            if (strcmp($tiles[$i][$j], "X") == 0 || strcmp($tiles[$i][$j], "O") == 0){
                $empty_spaces--;
            }
        }
        if ($empty_spaces == 0){ //Check if there are N number of Xs horizontally
            $draw = true;
        } else {
            $draw = false;
        }
    }
?>
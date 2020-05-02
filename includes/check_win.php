<?php
    $log->lwrite("checkwin table state utan");

    //Check horizontal lines
    for ($i = 0; $i < $size; $i++){
        $x_count = 0;
        $o_count = 0;
        for ($j = 0; $j < $size; $j++){
            //Check horizontal Xs
            if (strcmp($tiles[$i][$j], "X") == 0){
                $x_count++;
            }
            //Check horizontal Os
            if (strcmp($tiles[$i][$j], "O") == 0){
                $o_count++;
            }
        }
        if ($x_count == 5){ //Check if there are N number of Xs horizontally
            $x_won = true;
        }elseif ($o_count == 5) { //Check if there are N number of Os horizontally
            $o_won = true;
        }
    }
    ///Check vertical lines
    for ($j = 0; $j < $size; $j++){
        $x_count = 0;
        $o_count = 0;
        
        for ($i = 0; $i < $size; $i++){
            //Check vertical Xs
            if (strcmp($tiles[$i][$j], "X") == 0){
                $x_count++;
            }
            //Check vertical Os
            if (strcmp($tiles[$i][$j], "O") == 0){
                $o_count++;
            }
        }
        /* $log->lwrite("X count:".x_count); */
        if ($x_count == 5){ //Check if there are N number of Xs vertically
           
            $x_won = true;
        }elseif ($o_count == 5) { //Check if there are N number of Os vertically
            $o_won = true;
        }
    }
    //Check main diagonal
    $x_count = 0;
    $o_count = 0;
    for ($i = 0; $i < $size; $i++){
        
        
        for ($j = 0; $j < $size; $j++){
            
            if ($i == $j)
            {
                if (strcmp($tiles[$i][$j], "X") == 0){
                    $x_count++;
                }
                //Check vertical Os
                if (strcmp($tiles[$i][$j], "O") == 0){
                    $o_count++;
                }
            }
            
        }
        if ($x_count == 5){ //Check if there are N number of Xs on the main diagonal
            $x_won = true;
        }elseif ($o_count == 5) { //Check if there are N number of Os on the main diagonal
            $o_won = true;
        }
    }
    //Check secondary diagonal
    $x_count = 0;
    $o_count = 0;
    for ($i = 0; $i < $size; $i++){    
        for ($j = 0; $j < $size; $j++){
            
            if (($i + $j) == ($size - 1))
            {
                /* $log->lwrite("i+j: ".($i + $j));
                $log->lwrite("Size: ".$size); */
                if (strcmp($tiles[$i][$j], "X") == 0){
                    $x_count++;
                    /* $log->lwrite("x_count: ".($x_count)); */
                }
                //Check vertical Os
                if (strcmp($tiles[$i][$j], "O") == 0){
                    $o_count++;
                    /* $log->lwrite("o_count: ".($o_count)); */
                }
                /* $log->lwrite("\n"); */
            }
            
        }
        if ($x_count == 5){ //Check if there are N number of Xs on the secondary diagonal
            $x_won = true;
        }elseif ($o_count == 5) { //Check if there are N number of Os on the secondary diagonal
            $o_won = true;
        }
    }
?>
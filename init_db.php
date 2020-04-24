<?php
    require 'db_conn.php';

#region Create Database
    #region Database
    $sql = "CREATE DATABASE IF NOT EXISTS tictactoe";
    if (mysqli_query($conn, $sql)) {
        /* echo "Database created successfully"; */
    } else {
        /* echo "Error creating database: " . mysqli_error($conn); */
    }
    #endregion

    #region Game Table
    $sql = "CREATE TABLE IF NOT EXISTS games (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        player1_id INT(6) NOT NULL,
        player2_id VARCHAR(6) NOT NULL,
        winner_id INT(6),
        time_started TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        time_ended TIMESTAMP NULL DEFAULT NULL
        )";
        
    if (mysqli_query($conn, $sql)) {
        /* echo "Table games created successfully"; */
    } else {
        /* echo "Error creating table: " . mysqli_error($conn); */
    }
    #endregion

    #region Player Table
    $sql = "CREATE TABLE IF NOT EXISTS players (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        player_name INT(2) NOT NULL,
        on_turn BOOLEAN DEFAULT false
        )";
        
    if (mysqli_query($conn, $sql)) {
        /* echo "Table players created successfully"; */
    } else {
        /* echo "Error creating table: " . mysqli_error($conn); */
    }
    #endregion

    #region Tile Table
    $sql = "CREATE TABLE IF NOT EXISTS tiles (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        x_coord INT(2) NOT NULL,
        y_coord INT(2) NOT NULL,
        player_id INT(6),
        char_type VARCHAR(1)
        )";
        
    if (mysqli_query($conn, $sql)) {
       /*  echo "Table tiles created successfully"; */
    } else {
        /* echo "Error creating table: " . mysqli_error($conn); */
    }
    #endregion

    #region Turn Table
    $sql = "CREATE TABLE IF NOT EXISTS turns (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        game_id INT(6),
        player_id INT(6),
        tile_id INT(6),
        time_elapsed int(11)
        )";
        
    if (mysqli_query($conn, $sql)) {
        /* echo "Table turns created successfully"; */
    } else {
        /* echo "Error creating table: " . mysqli_error($conn); */
    }
    #endregion
#endregion

#region Add data
    #region Add Players
    $sql = "INSERT INTO `players` (player_name, on_turn)
    VALUES (\"Player1\", 0);";
    $sql = "INSERT INTO `players` (player_name, on_turn)
    VALUES (\"Player2\", 0);";

    if (mysqli_query($conn, $sql)) {
        /* echo "Players added successfully"; */
    } else {
        /* echo "Error: " . $sql . "<br>" . mysqli_error($conn); */
    }

    $sql = "INSERT INTO `players` (player_name, on_turn)
    VALUES (\"Player2\", 0);";

    if (mysqli_query($conn, $sql)) {
        /* echo "Players added successfully"; */
    } else {
        /* echo "Error: " . $sql . "<br>" . mysqli_error($conn); */
    }

    #endregion

    #region Add Tiles	
    for ($i = 0; $i < $size; $i++)
    {
        for ($j = 0; $j < $size; $j++)
        {
            $sql = "INSERT INTO `tiles` (x_coord, y_coord, char_type)
            VALUES (".$i.", ".$j.", \" \");";
            if (mysqli_query($conn, $sql)) {
                /* echo "Tiles added successfully"; */
            } else {
                /* echo "Error: " . $sql . "<br>" . mysqli_error($conn); */
            }
        }   
    }

    
    #endregion
#endregion
?> 
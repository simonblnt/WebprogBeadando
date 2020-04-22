<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "tictactoe";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

// Create database
$sql = "CREATE DATABASE tictactoe";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

// Create Game Table
$sql = "CREATE TABLE games (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    player1_id INT(6) NOT NULL,
    player2_id VARCHAR(6) NOT NULL,
    winner_id INT(6),
    time_started TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    time_ended TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
if (mysqli_query($conn, $sql)) {
    echo "Table games created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Create Player Table
$sql = "CREATE TABLE players (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    player_name INT(2) NOT NULL,
    on_turn BOOLEAN DEFAULT false
    )";
    
if (mysqli_query($conn, $sql)) {
    echo "Table players created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Create Tile Table
$sql = "CREATE TABLE tiles (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    x_coord INT(2) NOT NULL,
    y_coord INT(2) NOT NULL,
    player_id INT(6),
    char_type VARCHAR(1)
    )";
    
if (mysqli_query($conn, $sql)) {
    echo "Table tiles created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Create Turn Table
$sql = "CREATE TABLE turns (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    game_id INT(6),
    player_id INT(6),
    tile_id INT(6),
    time_elapsed int(11)
    )";
    
if (mysqli_query($conn, $sql)) {
    echo "Table turns created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}


mysqli_close($conn);
?> 
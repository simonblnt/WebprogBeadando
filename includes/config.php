<?php

include('log/logger.php');
$log = new Logging();
$log->lfile('log/log.txt');


if (session_status() != PHP_SESSION_ACTIVE) {
    /* $log->lwrite("session starts in config"); */
    session_start();
}

if (!isset($_SESSION["gameState"])) {
    /* $log->lwrite("gameState initializes in config"); */
    $_SESSION["gameState"] = "INITIAL";
}


$servername = "localhost";
$username = "root";
$password = "";
$db_name = "tictactoe";



// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$conn) {
    $log->lwrite(mysqli_connect_error());
    die("Connection failed: " . mysqli_connect_error());
}
$log->lwrite("Connected to database");
$log->lclose();
?>
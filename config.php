<?php
include('logger.php');
$log = new Logging();
$log->lfile('log.txt');

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
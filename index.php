<?php
    require_once 'includes/config.php';
?>
<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/WebprogBeadando/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Nova Flat' rel='stylesheet'>
</head>

<body>
    
    <div class="game-wrapper">
        <?php
            $size = 5;

            if ($_SESSION['gameState'] == "ONGOING" || $_SESSION['gameState'] == "INITIAL")
            {
                require 'control_bar.php';
            } else {
                require 'end_game_bar.php';
            }
            require 'game.php';
        ?>
    </div>
</body>
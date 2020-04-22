<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/WebprogBeadando/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Nova Flat' rel='stylesheet'>
</head>

<body>
    <div class="game-wrapper">
        <?php
            new TicTacToe();
        ?>
      <div class="control-wrapper">
        <form action="" class="control">
            <input type="text" id="x_coord" name="x_coord" class="item coordinate" value="">
            <input type="text" id="y_coord" name="y_coord" class="item coordinate" value="">
            <select name="" id="char_type" class="item char-select"></select>
            <input type="submit" class="item btn" value="Submit">
        </form>
      </div>
      <div class="table-wrapper">
            <table class="game-table">
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
      </div>
    </div>
</body>
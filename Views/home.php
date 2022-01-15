<!DOCTYPE html>
<html>
<head>
    <title>Memory Game</title>
    <link href="/assets/css/styles.css" rel="stylesheet">
    <script src="/assets/js/jquery-1.11.0.min.js"></script>
    <script src="/assets/js/game.js"></script>
</head>
<body>
<div id="board">
    <?php
    $board = $game->getBoard();
    $rows = $game->getNumberOfRows();
    $columns = $game->getNumberOfColumns();
    $k = 0;
    for ($i = 0; $i < $rows; $i++) {
        echo '<div class="row">';
        for ($j = 0; $j < $columns; $j++) {

            ?>
            <div class="card" data-index="<?php echo $k ?>"></div>
            <?php
            $k++;
        }

        echo "</div>";
    }
    ?>
</div>
</body>
</html>
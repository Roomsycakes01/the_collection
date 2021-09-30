<?php
require_once('gameListFunctions.php');
$db = dbConnection();
$objectArray = objectArray(fullQuery($db));
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>The Collection</title>
    <link rel='stylesheet' href='normalize.css' />
    <link rel='stylesheet' href='collection.css' />
</head>
<body>
    <header>
        <h1>Home</h1>
    </header>
    <nav>
        <a href='saveGame.php'>Add a game</a>
        <a href='editGame.php'>Edit a game</a>
        <a href='deleteGame.php'>Delete a game</a>
    </nav>
    <ul>
        <?php
            echo listGen($objectArray);
        ?>
    </ul>
</body>
</html>

<?php
require_once('gameListFunctions.php');
$db = dbConnection();
$objectArray = objectArray(fullQuery($db));
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <title>The Collection</title>
    <link rel='stylesheet' href='normalize.css'/>
</head>
<body>
    <h1>Home</h1>
    <a href='saveGame.php'>Add a game</a>
    <a href='editGame.php'>Edit a game</a>
    <a href='deleteGame.php'>Delete a game</a>
    <?php
    echo listGen($objectArray);
    ?>
</body>
</html>
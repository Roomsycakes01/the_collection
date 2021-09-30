<?php
require_once('gameListFunctions.php');
$db = dbConnection();
$pageCheck = 'save';
formReader($db,$pageCheck);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <title>Save Game</title>
    <link rel='stylesheet' href='normalize.css'/>
    <link rel='stylesheet' href='collection.css'/>
</head>
<body>
    <a href='index.php'>Home</a>
    <form method='post'>
        <label>name:
            <input name='name' type='text'/>
        </label>
        <label>genre:
            <input name='genre' type='text'/>
        </label>
        <label>length:
            <input name='length' type='number'/>
        </label>
        <label>price:
            <input name='price' type='number' step='any'/>
        </label>
        <input type='submit'/>
    </form>
</body>
</html>

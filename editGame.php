<?php
require_once('gameListFunctions.php');
$db = dbConnection();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <title>The Collection</title>
    <link rel='stylesheet' href='normalize.css'/>
    <link rel='stylesheet' href='collection.css'/>
</head>
<body>
<a href='index.php'>Home</a>
<form method='post' action='editGameStats.php' >
    <label>name:
        <select name='name' autocomplete='off'>
             <?php echo dropDownOptions(nameQuery($db)); ?>
        </select>
    </label>
    <input type='submit'/>
</form>
<p> Enter the name of the game you want to edit.</p>
</body>
</html>

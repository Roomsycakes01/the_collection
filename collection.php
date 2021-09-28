<!DOCTYPE html>
<html lang='en'>
<?php
require_once('gameListFunctions.php');
$db = dbConnection();
formReader($db);
$data = fullQuery($db);
$objectArray = objectArray($data);
?>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <title>The Collection</title>
    <link rel='stylesheet' href='normalize.css'/>
</head>
<body>

    <form method='POST'>
        <label>name:</label><input name='name' type='text'/>
        <label>genre:</label><input name='genre' type='text'/>
        <label>length:</label><input name='length' type='text'/>
        <label>price:</label><input name='price' type='text'/>
        <input type='submit'/>
    </form>
    <?php
        echo listGen($objectArray);
    ?>
</body>
</html>
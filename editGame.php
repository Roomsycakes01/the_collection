<?php
require_once('gameListFunctions.php');
$db = dbConnection();
$pageCheck = 'edit';
formReader($db,$pageCheck);
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
<a href='index.php'>Home.</a>
<form method='post'>
    <label>Name:
        <input name='name' type='text'/>
    </label>
    <label>Genre:
        <input name='genre' type='text'/>
    </label>
    <label>Name:
        <input name='length' type='text'/>
    </label>
    <label>Name:
        <input name='price' type='text'/>
    </label>
    <input type='submit'/>
</form>
</body>
</html>

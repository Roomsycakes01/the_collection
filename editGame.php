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
    <label for='name'>Name:</label>
        <input name='name' id='name' type='text'/>
    <label for='genre'>Genre:</label>
        <input name='genre' id='genre' type='text'/>
    <label for='length'>Name:</label>
        <input name='length' id='length' type='text'/>
    <label for='price'>Name:</label>
        <input name='price' id='price' type='text'/>
    <input type='submit'/>
</form>
</body>
</html>

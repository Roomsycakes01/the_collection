<?php
require_once('gameListFunctions.php');
$db = dbConnection();
$pageCheck = 'edit';
formReader($db,$pageCheck);
if(isset($_POST) && isset($_POST['name']) && count($_POST) === 1){
    $name = $_POST['name'];
    $game = new game($name);
    $game->addStats($db);
    $gameStats = $game->getter();
}
elseif(isset($_POST)){
    $name = $_POST['name'];
    $gameStats = [$_POST['genre'], $_POST['length'], $_POST['price']];
}
else{
    $name = null;
    $gameStats = null;
    header('Location: index.html');
}
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
<a href='index.php'>Home.</a>
<h1> Edit <?php echo $name ?></h1>
<form method='post'>
    <input name='name' type='hidden' value='<?php echo $name ?>' />
    <label>genre:
        <input name='genre' type='text' value='<?php echo $gameStats['genre']?>' />
    </label>
    <label>length:
        <input name='length' type='number' value='<?php echo $gameStats['length']?>' />
    </label>
    <label>price:
        <input name='price' type='number' step='any' value='<?php echo $gameStats['price']?>' />
    </label>
    <input type='submit'/>
</form>
<p> Enter the stats you want to edit in .</p>
</body>
</html>

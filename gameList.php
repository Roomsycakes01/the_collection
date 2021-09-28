<?php

$db = new PDO ('mysql:host=db;dbname=collection', 'root', 'password');

$db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$testIfEmpty = $_POST;
$testIfEmpty[] = "";
if(isset($_POST) && count(array_unique($testIfEmpty)) !== 1 ){
    addStats($_POST['name'],$_POST['genre'],$_POST['length'], $_POST['price'],$db);
}

$fullQuery = $db->prepare( 'SELECT `name`, `genre`, `length`, `price` FROM `games`;');

$fullQuery->execute();

$data = $fullQuery -> fetchAll();

require_once 'gameClass.php';

/**
 * Generates the full list of objects based on the data
 *
 * @param array $data
 * @return array
 */
function objectArray(Array $data) : Array{
    $objectArray = [];
    foreach($data as $game){
        $gameObject = new Game($game['name'], $data);
        $objectArray[] = $gameObject;
    }
    return $objectArray;
}

/**
 * adds a new item into the database.
 *
 * @param String $name
 * @param String $genre
 * @param Int $length
 * @param Float $price
 * @param PDO $db
 */
function addStats(String $name, String $genre, Int $length, Float $price, PDO $db){

    $addQuery = $db -> prepare('INSERT INTO `games`(`name`,`genre`,`length`,`price`) VALUES (:name, :genre, :length, :price);');
    $addQuery -> execute(['name' => $name, 'genre' => $genre, 'length' => $length, 'price' => $price]);

}
$objectArray = objectArray($data);

echo '<ul>';
foreach ($objectArray as $object) {
    echo '<li>' . $object -> strParams() . '. </li>';
}
echo '</ul>';


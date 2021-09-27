<?php

$db = new PDO ('mysql:host=db;dbname=collection', 'root', 'password');

$db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$nameQuery = $db->prepare( 'SELECT `name` FROM `games`;');

$nameQuery->execute();

$names = $nameQuery -> fetchAll();


class Game
{
    protected $name;
    protected $genre;
    protected $length;
    protected $price;

    public function __construct(String $name, PDO $db, Bool $add = false, String $genre = '', String $length ='', String $price ='')
    {
        if($this->nameSearch($name,$db) === true){
            $this -> name = $name;
            $this -> getStats($name,$db);
        }
        elseif($add === true){
            $this->addStats($name, $genre, $length, $price, $db);
        }
        else{
            echo 'The name you entered is not in the collection.';
        }

    }
    public function getParams() :Array
    {
        return ['name' => $this -> name, 'genre' =>$this -> genre, 'length' => $this -> length, 'price' => $this -> price];
    }
    protected function nameSearch( String $name, PDO $db) : Bool
    {
        $nameQuery = $db->prepare( 'SELECT `name` FROM `games`;');
        $nameQuery -> execute();
        $names = $nameQuery -> fetchAll();
        $editedNames = [];
        foreach ($names as $n){
            $editedNames[] = $n['name'];
        }
        return in_array($name, $editedNames);
    }
    protected function getStats(String $name, PDO $db)
    {
        $searchQuery = $db->prepare( 'SELECT `name`, `genre`, `length`, `price` FROM `games` WHERE name = :name ;');
        $searchQuery -> execute([ 'name' => $name]);
        $gameData = $searchQuery -> fetchAll();
        $this -> genre = $gameData[0]['genre'];
        $this -> length = $gameData[0]['length'];
        $this -> price = $gameData[0]['price'];
    }
    protected function addStats(String $name, String $genre, Int $length, Float $price, PDO $db)
    {
        $addQuery = $db -> prepare('INSERT INTO `games`(`name`,`genre`,`length`,`price`) VALUES (:name, :genre, :length, :price);');
        $addQuery -> execute(['name' => $name, 'genre' => $genre, 'length' => $length, 'price' => $price]);
    }
}

function gamesArrayGen(PDO $db) : Array {
    $nameQuery = $db->prepare( 'SELECT `name` FROM `games`;');
    $nameQuery->execute();
    $names = $nameQuery -> fetchAll();
    $gamesList = [];
    $finalGamesList = [];
    foreach($names as $name){
        $game = new Game($name['name'], $db);
        $gamesList[] = $game;
    }
    foreach($gamesList as $game2){
        $game2Array = $game2->getParams();
        $finalGamesList[] = $game2Array;
    }
    return $finalGamesList;
}

function listGen(Array $bigArray)
{
    echo '<ul>';
    foreach ($bigArray as $array) {
        $tracker = 0;
        echo '<li>';
        foreach ($array as $item) {
            if ($tracker === 0) {
                echo $item;
                $tracker = 1;
                continue;
            }
            echo ", $item";
        }
        echo '. </li>';
    }
    echo '</ul>';
}

new Game('WoW', $db, true, 'MMO RPG', '300','59.99');

$gamesList = gamesArrayGen($db);

listGen($gamesList);


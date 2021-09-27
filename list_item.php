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

    public function __construct(String $name, PDO $db, Bool $add = false)
    {
        if($this->nameSearch($name,$db) === true){
            $this -> name = $name;
            $this -> getStats($name,$db);
        }
        elseif($add === true){
            echo 'wip';
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
        $searchQuery = $db->prepare( 'SELECT `name`, `genre`, `length`, `price` FROM `games` WHERE name = :name');
        $searchQuery -> execute([ 'name' => $name]);
        $gameData = $searchQuery -> fetchAll();
        $this -> genre = $gameData[0]['genre'];
        $this -> length = $gameData[0]['length'];
        $this -> price = $gameData[0]['price'];
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

$gamesList = gamesArrayGen($db);

listGen($gamesList);


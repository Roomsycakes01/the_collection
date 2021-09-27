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

    /**
     * The constructor for the Game object, only needs a name and the db to search the db and create a new object, if the add section is set to true th constructor can add a new item to the db
     *
     * @param String $name
     * @param PDO $db
     * @param bool $add
     * @param String $genre
     * @param String $length
     * @param String $price
     */
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

    /**
     * returns an array of all the objects parameters.
     *
     * @return array
     */
    public function getParams() :Array
    {
        return ['name' => $this -> name, 'genre' =>$this -> genre, 'length' => $this -> length, 'price' => $this -> price];
    }
    
    /**
     * Checks to see if the inputted name is in the db.
     *
     * @param String $name
     * @param PDO $db
     * @return bool
     */
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

    /**
     * when given a name assigns the values of the other stats to the object from the database.
     *
     * @param String $name
     * @param PDO $db
     */
    protected function getStats(String $name, PDO $db)
    {
        $searchQuery = $db->prepare( 'SELECT `name`, `genre`, `length`, `price` FROM `games` WHERE name = :name ;');
        $searchQuery -> execute([ 'name' => $name]);
        $gameData = $searchQuery -> fetchAll();
        $this -> genre = $gameData[0]['genre'];
        $this -> length = $gameData[0]['length'];
        $this -> price = $gameData[0]['price'];
    }

    /**
     * adds the inputted stats into a new item in the db
     *
     * @param String $name
     * @param String $genre
     * @param Int $length
     * @param Float $price
     * @param PDO $db
     */
    protected function addStats(String $name, String $genre, Int $length, Float $price, PDO $db)
    {
        $addQuery = $db -> prepare('INSERT INTO `games`(`name`,`genre`,`length`,`price`) VALUES (:name, :genre, :length, :price);');
        $addQuery -> execute(['name' => $name, 'genre' => $genre, 'length' => $length, 'price' => $price]);
    }
}

/**
 * generates a list of all the games and info about them in the db
 *
 * @param PDO $db
 * @return array
 */
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

/**
 * generates a comma seperated list in html of the inputted array
 *
 * @param array $bigArray
 */
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
$testIfEmpty = $_POST;
$testIfEmpty[] = "";
if(isset($_POST) && count(array_unique($testIfEmpty)) !== 1 ){
    new Game($_POST['name'],$db,true,$_POST['genre'],$_POST['length'], $_POST['price']);
}
$gamesList = gamesArrayGen($db);
listGen($gamesList);


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
     * @param Array $data
     */
    public function __construct(String $name, Array $data)
    {
        if($this->nameSearch($name,$data) === true){
            $this -> name = $name;
            $this -> importStats($name,$data);
        }
        else{
            echo 'The name you entered is not in the collection.';
        }

    }

    /**
     * echos the objects parameters as a list item.
     *
     */
    public function echoParams()
    {
        echo $this -> name . ', ' . $this -> genre . ', ' . $this -> length . ', ' . $this -> price;
    }

    /**
     * Checks to see if the inputted name is in the db.
     *
     * @param String $name
     * @param Array $data
     * @return bool
     */
    protected function nameSearch( String $name, Array $data) : Bool
    {
        $editedNames = [];
        foreach ($data as $game){
            $editedNames[] = $game['name'];
        }
        return in_array($name, $editedNames);
    }

    /**
     * when given a name assigns the values of the other stats to the object from the database.
     *
     * @param String $name
     * @param Array $data
     */
    protected function importStats(String $name, Array $data)
    {
        foreach ($data as $game){
            if ($name === $game['name']){
                $this -> genre = $game['genre'];
                $this -> length = $game['length'];
                $this -> price = $game['price'];
                break;
            }
        }
    }
}

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
 * generates a comma seperated list in html of the inputted array of objects with an echo function in the object
 *
 * @param array $objectArray
 */
function listGen(Array $objectArray)
{
    echo '<ul>';
    foreach ($objectArray as $object) {
        echo '<li>';
        $object -> echoParams();
        echo '. </li>';
    }
    echo '</ul>';
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
listGen($objectArray);


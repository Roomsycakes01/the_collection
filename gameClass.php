<?php

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
     * @param String $genre
     * @param Int $length
     * @param Float $price
     *
     */
    public function __construct(String $name, String $genre = '', Int $length = 0, Float $price = 0)
    {
        $this->name = $name;
        $this->genre = $genre;
        $this->length = $length;
        $this->price = $price;
    }

    /**
     * Allows you to get the objects parameters if needed
     *
     * @return array
     */
    public function getter() : Array{
        return ['name' => $this->name,'genre' => $this->genre,'length' => $this->length,'price' => $this->price];
    }

    /**
     * Allows you to generate the objects stats from the db based on the name, returns true if successful.
     *
     * @param PDO $db
     * @return bool
     */
    public function addStats(PDO $db) : bool
    {
        $addStats = $db->prepare('SELECT `name`, `genre`, `length`, `price` FROM `games` WHERE `name` = :name ;');
        $test = $addStats->execute(['name' => $this->name]);
        $statArray = $addStats-> fetch();
        $this->genre = $statArray['genre'];
        $this->length = $statArray['length'];
        $this->price = $statArray['price'];
        return $test;
    }

    /**
     * echos the objects parameters as a list item.
     *
     * @return String
     */
    public function strParams() : String
    {
        return $this->name . ', ' . $this->genre . ', ' . $this->length . ', ' . $this->price;
    }

    /**
     * Adds the object into the database or undeletes it if it's flagged as deleted in the db, returns true if successful and false otherwise.
     *
     * @param PDO $db
     * @return Bool
     */
    public function saveGame(PDO $db) : Bool
    {
        $gameIsDeleted = $db->prepare('SELECT `delete` FROM `games` WHERE `name` = :name ;');
        $gameIsDeleted->execute(['name' =>$this->name]);
        $testArray = $gameIsDeleted->fetch();
        if($testArray === ['delete' => '1']){
            $restoreQuery = $db->prepare('UPDATE `games` SET `delete` = 0 WHERE `name` = :name AND `delete` = 1 LIMIT 1 ;');
            $this->editGame($db);
            return $restoreQuery->execute(['name' => $this->name]);
        }
        elseif($testArray === ['delete' => '0']){
            echo 'Game already in the collection';
            return false;
        }
        else{
            $addQuery = $db->prepare('INSERT INTO `games`(`name`,`genre`,`length`,`price`) VALUES (:name, :genre, :length, :price);');
            return $addQuery->execute(['name' => $this->name, 'genre' => $this->genre, 'length' => $this->length, 'price' => $this->price]);
        }
    }

    /**
     * Edits an object in the database, searches by name. Returns true if successful and false otherwise.
     *
     * @param PDO $db
     * @return Bool
     */
    public function editGame(PDO $db) : Bool
    {
        $editQuery = $db->prepare('UPDATE `games` SET `genre` = :genre, `length` = :length, `price` = :price WHERE `name` = :name LIMIT 1;');
        return $editQuery->execute(['name' => $this->name, 'genre' => $this->genre, 'length' => $this->length, 'price' => $this->price]);
    }

    /**
     * Deletes an object from the database, searches by name. Returns true if successful and false otherwise.
     *
     * @param PDO $db
     * @return Bool
     */
    public function deleteGame(PDO $db) : Bool
    {
        $deleteQuery = $db->prepare('UPDATE `games` SET `delete` = 1 WHERE `name` = :name AND `delete` = 0 LIMIT 1;');
        return $deleteQuery->execute(['name' => $this->name]);
    }
}


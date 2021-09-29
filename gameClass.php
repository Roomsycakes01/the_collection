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
    public function __construct(String $name, String $genre = 'placeholder', Int $length = 0, Float $price = 0)
    {
        $this->name = $name;
        $this->genre = $genre;
        $this->length = $length;
        $this->price = $price;
    }

    /**
     * Allows ou to get the objects parameters if needed
     *
     * @return array
     */
    public function getter() : Array{
        return [$this->name,$this->genre,$this->length,$this->price];
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
        $nameQuery = $db->prepare('SELECT `name`, `delete` FROM `games` WHERE `name` = :name AND `delete` = 1 ;');
        $test = $nameQuery->execute(['name' =>$this->name]);
        if($test){
            $restoreQuery = $db->prepare('UPDATE `games` SET `delete` = 0 WHERE `name` = :name AND `delete` = 1 LIMIT 1 ;');
            $this->editGame($db);
            return $restoreQuery->execute(['name' => $this->name]);
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


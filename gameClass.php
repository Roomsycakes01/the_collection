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
    public function __construct(String $name, String $genre, Int $length, Float $price)
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
     * adds the object into the database
     *
     * @param $db
     * @return Void
     */
    public function saveGame($db) : Void
    {
        $addQuery = $db -> prepare('INSERT INTO `games`(`name`,`genre`,`length`,`price`) VALUES (:name, :genre, :length, :price);');
        $addQuery -> execute(['name' => $this->name, 'genre' => $this->genre, 'length' => $this->length, 'price' => $this->price]);

    }
}

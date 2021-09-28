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
     * @return String
     */
    public function strParams() : String
    {
        return $this -> name . ', ' . $this -> genre . ', ' . $this -> length . ', ' . $this -> price;
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

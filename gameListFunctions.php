<?php

require_once 'gameClass.php';

/**
 * This code connects to the mySQL database
 *
 * @return PDO
 */
function dbConnection() : PDO{
    $db = new PDO ('mysql:host=db;dbname=collection', 'root', 'password');

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

/**
 * This code gets an array of the full database
 *
 * @param PDO $db
 * @return array
 */
function fullQuery(PDO $db) : Array
{
    $fullQuery = $db->prepare('SELECT `name`, `genre`, `length`, `price` FROM `games`;');
    $fullQuery->execute();
    return $fullQuery->fetchAll();
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
        $objectArray[] = new Game($game['name'], $game['genre'], $game['length'], $game['price']);
    }
    return $objectArray;
}

/**
 * generates a list of the games and their parameters in an array of game objects
 *
 * @param Array $objectArray
 * @return String
 */
function listGen(Array $objectArray) : String {
    $returnString = '<ul>';
    foreach ($objectArray as $object) {
        $returnString .= '<li>' . $object->strParams() . '. </li>';
    }
    return $returnString . '</ul>';
}

/**
 * Checks which method to edit the database with then makes an object using the form inputs and applies the save, edit or delete function to it.
 * If the function called is successful this function then returns you to the homepage.
 *
 * @param PDO $db
 * @param String $pageCheck
 * @return Void
 */

function formReader(PDO $db, String $pageCheck) : Void
{
    if (isset($_POST) && in_array("", $_POST) === false) {
        if ($pageCheck === 'save' && array_map('is_numeric', $_POST) === ['name' => false, 'genre' => false, 'length' => true, 'price' => true]) {
            $game = new Game($_POST['name'], $_POST['genre'], $_POST['length'], $_POST['price']);
            $test = $game->saveGame($db);
            if ($test) {
                header('Location: index.php');
            }
        } elseif ($pageCheck === 'edit' && array_map('is_numeric', $_POST) === ['name' => false, 'genre' => false, 'length' => true, 'price' => true]) {
            $game = new Game($_POST['name'], $_POST['genre'], $_POST['length'], $_POST['price']);
            $test = $game->editGame($db);
            if ($test) {
                header('Location: index.php');
            }
        } elseif ($pageCheck === 'delete' && isset($_POST['name'])) {
            $game = new Game($_POST['name']);
            $test = $game->deleteGame($db);
            if ($test) {
                header('Location: index.php');
            }
        }
    }
}



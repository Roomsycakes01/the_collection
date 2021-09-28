<?php declare(strict_types=1);

require_once 'gameClass.php';

use PHPUnit\Framework\TestCase;


class gameClassTest extends TestCase
{
    public function testGetParams()
    {
        $data = [['name' => 'Journey', 'genre' => 'RPG', 'length' => 15, 'price' => 9.99]];
        $game = new Game('Journey', $data);
        $result = $game->strParams();
        $this -> assertEquals('Journey, RPG, 15, 9.99', $result);
    }
}
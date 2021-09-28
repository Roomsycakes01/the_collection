<?php declare(strict_types=1);

require_once 'gameClass.php';

use PHPUnit\Framework\TestCase;


class gameClassTest extends TestCase
{
    public function testSuccessStrParams()
    {
        $game = new Game('Journey', 'RPG', 15, 9.99);
        $result = $game->strParams();
        $this->assertEquals('Journey, RPG, 15, 9.99', $result);
    }
    public function testMalformedStrParams()
    {
        $this->expectException(TypeError::class);
        $game = new Game(['Journey'], 'RPG', 15, 9.99);
        $result = $game->strParams();
    }
    public function testSuccessGetter()
    {
        $game = new Game('Journey', 'RPG', 15, 9.99);
        $result = $game->getter();
        $this->assertEquals(['Journey', 'RPG', 15, 9.99], $result);
    }
    public function testMalformedGetter()
    {
        $this->expectException(TypeError::class);
        $game = new Game(['Journey'], 'RPG', 15, 9.99);
        $result = $game->getter();
    }

}
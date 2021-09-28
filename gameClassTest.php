<?php declare(strict_types=1);

require_once 'gameClass.php';

use PHPUnit\Framework\TestCase;


class gameClassTest extends TestCase
{
    public function testSuccessGetParams()
    {
        $game = new Game('Journey', 'RPG', 15, 9.99);
        $result = $game->strParams();
        $this->assertEquals('Journey, RPG, 15, 9.99', $result);
    }
    public function testSuccessGetter()
    {
        $game = new Game('Journey', 'RPG', 15, 9.99);
        $result = $game->getter();
        $this->assertEquals(['Journey', 'RPG', 15, 9.99], $result);
    }

}
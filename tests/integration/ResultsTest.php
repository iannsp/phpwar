<?php

use Iannsp\PhpWar\Geometry\Cartesian;

class ResultsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function end_game_result()
    {
        $arenaWidth = 10;
        $arenaHeight = 10;
        $arenaLimits = new Cartesian\Point($arenaWidth, $arenaHeight);
        $scoreStrategy = array(
            'Hit'=>'\\Iannsp\PhpWar\\Game\\Score\\Hit',
            'Neibor'=>'\\Iannsp\PhpWar\\Game\\Score\\Neibor',
        );
        $arena = new Iannsp\PhpWar\Arena($arenaLimits, $scoreStrategy);
        $players = array (
            new Iannsp\PhpWar\Player\P1($arena->getLimits()),
            new Iannsp\PhpWar\Player\P1($arena->getLimits())
        );
        $game = new Iannsp\PhpWar\Game($arena, $players);
        $moves = 0;
        while($moves < 100){
            $game->round();
            $moves++;
        }

        $stats = $arena->stats();
        $this->assertArrayHasKey(
            1,
            $stats,
            'Missing player 1 on status.'
        );
        $this->assertArrayHasKey(
            0,
            $stats,
            'Missing player 0 on status.'
        );
        $this->assertGreaterThan(
            $stats[0],
            $stats[1],
            'Expected that player 1 wins every time.'
        );
    }
}

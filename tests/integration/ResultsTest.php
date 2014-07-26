<?php

class ResultsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function end_game_result()
    {
        $arenaWidth = 10;
        $arenaHeight = 10;
        $arena = new Iannsp\PhpWar\Arena($arenaWidth, $arenaHeight);
        $players = array (
            new Iannsp\PhpWar\Player\P1($arena->getWidth(), $arena->getHeight()),
            new Iannsp\PhpWar\Player\P1($arena->getWidth(), $arena->getHeight())
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

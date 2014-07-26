<?php
namespace Iannsp\PhpWar;
    
class ArenaTest extends \PHPUnit_Framework_TestCase{
    
    
    public function testDimensions()
    {
        $width = 4;
        $height= 3;
        $arena = new Arena($width, $height);
        $this->assertEquals($width, $arena->getWidth());
        $this->assertEquals($height, $arena->getHeight());
    }
    
    public function testStatsNewGame()
    {
        $arena = new Arena(4,4);
        $stats = $arena->stats();
        $this->assertCount(1, $stats);
        $this->assertArrayHasKey('.', $stats);
        $this->assertContains(16, $stats);
    }
    
    public function testStatsWithMoves()
    {
        $arena = new Arena(4,4);
        $move  = new Move(0,1);
        $playerId = 'A';
        $arena->setMove($playerId,$move);
        $stats = $arena->stats();
        $this->assertCount(2, $stats);
        $this->assertArrayHasKey('.', $stats);
        $this->assertArrayHasKey($playerId, $stats);
        $this->assertEquals(15, $stats['.']);
        $this->assertEquals(1, $stats[$playerId]);
    }

    public function testGetArenaNewGame()
    {
        $arena = new Arena(4,4);
        $arenaSpace = $arena->getArena();
        $this->assertCount(4, $arenaSpace);
        $this->assertCount(4, $arenaSpace[0]);
        foreach($arenaSpace as $lines){
            $this->assertEquals('.',implode('',array_unique($lines)));
        }
    }
    public function testSetMoveOverwritePosition()
    {
        $arena = new Arena(4,4);
        $move  = new Move(0,1);
        $playerAId = 'A';
        $playerBId = 'B';
        $arena->setMove($playerAId,$move);
        $arenaSpace = $arena->getArena();
        $this->assertEquals($playerAId, $arenaSpace[0][1]);
        $arena->setMove($playerBId,$move);
        $arenaSpace = $arena->getArena();
        $this->assertEquals($playerBId, $arenaSpace[0][1]);
    }
    public function testSetMoveWithHitStrategy()
    {
        $arena = new Arena(4,4, array('Hit'=>'\\Iannsp\PhpWar\\Game\\Score\\Hit'));
        $move  = new Move(0,1);
        $playerAId = 'A';
        $playerBId = 'B';
        $arena->setMove($playerAId,$move);
        $arenaSpace = $arena->getArena();
        $this->assertEquals($playerAId, $arenaSpace[0][1]);
        $arena->setMove($playerBId,$move);
        $arenaSpace = $arena->getArena();
        $this->assertEquals($playerBId, $arenaSpace[0][1]);
    }
    public function testSetMoveWithNeiborStrategy()
    {
        $arena = new Arena(4,4, array('Neibor'=>'\\Iannsp\PhpWar\\Game\\Score\\Neibor'));
        $playerAId = 'A';
        $playerBId = 'B';
        $this->AssertTrue($arena->setMove($playerAId,new Move(0,1)),'A play 0,1');
        $this->AssertTrue($arena->setMove($playerAId,new Move(1,1)),'A play 1,1');
        $this->AssertTrue($arena->setMove($playerAId,new Move(1,0)));
        $this->assertFalse($arena->setMove($playerBId,new Move(0,0)),'B play 0,0');
        $this->assertFalse($arena->setMove($playerBId,new Move(1,1)),'B play 1,1');
    }
}

/*
,
        'Neibor'=>'\\Iannsp\PhpWar\\Game\\Score\\Neibor',
*/
<?php
namespace Iannsp\PhpWar\Game\Score;
use Iannsp\PhpWar\Arena;
use Iannsp\PhpWar\Move;
use Iannsp\PhpWar\Geometry\Cartesian\Point as CartesianPoint;
class NeighborTest  extends \PHPUnit_Framework_TestCase
{
    
    /**
    * @test
    */
    public function play_to_win()
    {
        $scoreStrategy = array(
            'Hit'=>'\\Iannsp\PhpWar\\Game\\Score\\Neibor'
        );
        $arenaLimits = new CartesianPoint(2,2);
        $arena = new Arena($arenaLimits, $scoreStrategy);
        $this->assertCount(1,$arena->play('X', new Move(1,1))->getWinners());
    }

    /**
    * @test
    */
    public function play_to_Lose()
    {
        $scoreStrategy = array(
            'Hit'=>'\\Iannsp\PhpWar\\Game\\Score\\Neibor'
        );
        $arenaLimits = new CartesianPoint(2,2);
        $arena = new Arena($arenaLimits, $scoreStrategy);
        $this->assertCount(1,$arena->play('X', new Move(1,1))->getWinners(),'Win by empty position');
        $this->assertCount(1,$arena->play('Y', new Move(1,1))->getWinners(),'Win because has no Hit Rule');
        $this->assertCount(1,$arena->play('X', new Move(1,1))->getWinners(),'Win because has no Hit Rule');
        $this->assertCount(1,$arena->play('X', new Move(0,1))->getWinners(),'Win by empty position');
        $feedback = $arena->play('Y', new Move(0,2));
        $this->assertCount(0,$feedback->getWinners(),'2 X neighbors made Y lose');
        $this->assertCount(1,$feedback->getLosers(),'Lose the warrior');
        $this->assertCount(0,$feedback->getNeutralizeds(),'No Neutralizeds');
    }
}
<?php
namespace Iannsp\PhpWar\Game\Score;
use Iannsp\PhpWar\Arena;
use Iannsp\PhpWar\Move;
use Iannsp\PhpWar\Geometry\Cartesian\Point as CartesianPoint;
class HitTest  extends \PHPUnit_Framework_TestCase
{
    
    /**
    * @test
    */
    public function play_to_win()
    {
        $scoreStrategy = array(
            'Hit'=>'\\Iannsp\PhpWar\\Game\\Score\\Hit'
        );
        $arenaLimits = new CartesianPoint(2,2);
        $arena = new Arena($arenaLimits, $scoreStrategy);
        $this->assertCount(1,$arena->play('X', new Move(1,1))->getWinners());
    }

    /**
    * @test
    */
    public function play_to_Neutralize()
    {
        $scoreStrategy = array(
            'Hit'=>'\\Iannsp\PhpWar\\Game\\Score\\Hit'
        );
        $arenaLimits = new CartesianPoint(2,2);
        $arena = new Arena($arenaLimits, $scoreStrategy);
        $this->assertCount(1,$arena->play('X', new Move(1,1))->getWinners(),'Win by empty position');
        $this->assertCount(1,$arena->play('Y', new Move(1,1))->getNeutralizeds(),'Neutralize X in position');
        $this->assertCount(1,$arena->play('Y', new Move(1,1))->getWinners(),'Win by neutrilized(empty) position');
        $this->assertCount(1,$arena->play('X', new Move(1,1))->getNeutralizeds(),'Neutralize Y in position');
        $feedback = $arena->play('Y', new Move(1,1));
        $this->assertCount(1,$feedback->getWinners(),'Win by neutrilized(empty) position');
        $this->assertCount(0,$feedback->getLosers(),'No Losers');
        $this->assertCount(0,$feedback->getNeutralizeds(),'No Neutralized');
    }
}
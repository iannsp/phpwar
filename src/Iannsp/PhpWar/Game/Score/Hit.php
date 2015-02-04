<?php
namespace Iannsp\PhpWar\Game\Score;
use Iannsp\PhpWar\Game\Feedback;
use Iannsp\PhpWar\Arena as Arena;
use Iannsp\PhpWar\Move as Move;

/*
* Hit consider just the position, so, always win in Hit analizes
* If a postions(x,Y) has another player and you Hit this position
* you win the position.    
*/
class Hit
{
    private $arena;
    public function __construct($arena)
    {
        $this->arena = $arena;
    }
    public function analyze($playerName, Move $move)
    {
        $feedback = new Feedback;
        $coordinates = $move->getCoordenates();
        $warPlace    = $this->arena->getArena();
        if (isset($warPlace[$coordinates['x']][$coordinates['y']])&& ($warPlace[$coordinates['x']][$coordinates['y']]=='.' ||
            $warPlace[$coordinates['x']][$coordinates['y']]==$playerName)
        ){
            $feedback->add(Feedback::WIN, $move);
        }
        if (isset($warPlace[$coordinates['x']][$coordinates['y']]) && ($warPlace[$coordinates['x']][$coordinates['y']]!='.' && 
            $warPlace[$coordinates['x']][$coordinates['y']]!=$playerName)){
            $feedback->add(Feedback::NEUTRALIZED, $move);
        }
        return $feedback;
    }
}
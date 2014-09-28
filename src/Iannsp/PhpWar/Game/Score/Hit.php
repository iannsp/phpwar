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

    /**
     * @var Arena
     */
    private $arena;

    public function __construct(Arena $arena)
    {
        $this->arena = $arena;
    }

    public function analyze($playerName, Move $move)
    {
        $feedback = new Feedback();
        $warPlace = $this->arena->getArena();

        list($x, $y) = array_values($move->getCoordenates());

        $delta = isset($warPlace[$x][$y]) ? $warPlace[$x][$y] : null;

        if ($delta == '.' || $delta == $playerName){
            $feedback->add(Feedback::WIN, $move);
        }

        if ($delta != '.' && $delta != $playerName){
            $feedback->add(Feedback::NEUTRALIZED, $move);
        }

        return $feedback;
    }
}

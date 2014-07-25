<?php
namespace Iannsp\PhpWar\Game\Score;
use \Iannsp\PhpWar\Arena as Arena;
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
        $coordinates = $move->getCoordenates();
        $warPlace    = $this->arena->getArena();
        return true;
    }
}
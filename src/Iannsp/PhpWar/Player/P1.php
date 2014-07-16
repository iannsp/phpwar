<?php
namespace Iannsp\PhpWar\Player;
use Iannsp\PhpWar\Move as move;
use \Iannsp\PhpWar\Arena as Arena;

class P1 implements playerInterface
{
    private $arena;
    public function __construct(Arena $arena)
    {
        $this->arena = $arena;
    }
    public function play()
    {
        $arenaHeight = $this->arena->getHeight();
        $arenaWidth  = $this->arena->getWidth();
       return new move(rand(0, $arenaHeight), rand(0,$arenaWidth)); 
    }
}



<?php
namespace Iannsp\PhpWar;
use \Iannsp\PhpWar\Arena as Arena;

class Game
{
    private $arena;
    private $warriors = array();
    public function __construct(Arena $arena, array $warriors)
    {
        $this->arena = $arena;
        $this->warriors = $warriors;
    }

    public function round()
    {
        foreach ($this->warriors as $wIdx => $warrior)
        {
            $move = $warrior->play();
            $this->arena->setMove($wIdx, $move);
        }
    }
}

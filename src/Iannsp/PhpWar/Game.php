<?php

namespace Iannsp\PhpWar;

use \Iannsp\PhpWar\Arena as Arena;
use Iannsp\PhpWar\Game\Turn;

class Game implements \IteratorAggregate, \SplObserver
{
    private $arena;
    private $warriors = array();
    private $turnControl = null;

    public function __construct(Arena $arena, array $warriors)
    {
        $this->arena = $arena;
        $this->warriors = $warriors;

        $this->turnControl = new Turn;
        $this->turnControl->attach($this);
    }

    public function getIterator()
    {
        return $this->turnControl;
    }

    public function update(\SplSubject $currentTurn)
    {
        foreach ($this->warriors as $wIdx => $warrior)
        {
            $move = $warrior->play();
            $warrior->feedback($this->arena->play($wIdx, $move));
        }
    }
}

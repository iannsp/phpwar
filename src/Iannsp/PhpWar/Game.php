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

        $this->turnControl = new Turn($this->arena->getLimits()->getX() * $this->arena->getLimits()->getY());
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

    public function render($frameRate)
    {
        $w = $this->arena->getLimits()->getX();
        $h = $this->arena->getLimits()->getY();
        $arenaArray = $this->arena->getArena();
        $print = chr(27) . "[2J" . chr(27) . "[;H";
        for ($x = 0; $x<$w; $x++)
        {
            for ($y=0; $y < $h; $y++)
            {
                $print.=" ".($arenaArray[$x][$y])." ";
            }
            $print.= "\n";
        }
        usleep(1000000/$frameRate);
        return $print;
    }
}

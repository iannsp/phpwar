<?php

namespace Iannsp\PhpWar\Player;

use Iannsp\PhpWar\Move;
use Iannsp\PhpWar\Geometry\Cartesian;

class P1 implements PlayerInterface
{
    private $arenaWidth  = 0;
    private $arenaHeight = 0;

    public function __construct(Cartesian\Point $arenaLimits)
    {
        $this->arenaWidth  = $arenaLimits->getX();
        $this->arenaHeight = $arenaLimits->getY();
    }

    public function play()
    {
        $arenaHeight = $this->arenaHeight-1;
        $arenaWidth  = $this->arenaWidth-1;

        return new Move(rand(0, $arenaHeight), rand(0,$arenaWidth));
    }

    public function feedback($status)
    {
        // use it to stat you play strategy.
    }
}



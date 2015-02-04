<?php
namespace Iannsp\PhpWar\Player;

use Iannsp\PhpWar\Move as move;
use Iannsp\PhpWar\Arena as Arena;
use Iannsp\PhpWar\Geometry\Cartesian;

class P2 implements playerInterface
{
    private $arenaWidth  = 0;
    private $arenaHeight = 0;
    private $lastW       = 0;
    private $lastH       = 0;

    public function __construct(Cartesian\Point $limits)
    {
        $this->arenaWidth  = $limits->getX();
        $this->arenaHeight = $limits->getY();
    }
    public function play()
    {

        $arenaHeight = $this->arenaHeight;
        $arenaWidth  = $this->arenaWidth;
        $h = $this->lastH;
        $this->lastW = $this->lastW +1;
        $w = $this->lastW;
        if ($this->lastW == $arenaHeight)
        {
            $this->lastH++;
            $this->lastW = 0;
        }
       return new move($h, $w);
    }

    public function feedback($status)
    {
     // use it to stat you play strategy.
    }
}



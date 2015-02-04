<?php
namespace Iannsp\PhpWar\Player;

use Iannsp\PhpWar\Move;
use Iannsp\PhpWar\Geometry\Cartesian;
use Iannsp\PhpWar\Game\Feedback;

class P1 implements playerInterface
{
    private $arenaWidth  = 0;
    private $arenaHeight = 0;
    private $nextMove;
    private $lastMove;
    public function __construct(Cartesian\Point $arenaLimits)
    {
        $this->arenaWidth  = $arenaLimits->getX();
        $this->arenaHeight = $arenaLimits->getY();
    }

    public function play()
    {
        $nextMove = $this->nextMove;
        if(!is_null($nextMove)){
            $this->nextMove = null;
            return $nextMove;
        }
        $arenaHeight = $this->arenaHeight-1;
        $arenaWidth  = $this->arenaWidth-1;
        $this->lastMove = new Move(rand(0, $arenaHeight), rand(0,$arenaWidth));
        return $this->lastMove;
    }

    public function feedback($status)
    {
        $neutralizeds = $status->getNeutralizeds();
        if (count($neutralizeds) && $neutralizeds[0]==$this->lastMove)
            $this->nextMove = $this->lastMove;
    }
}



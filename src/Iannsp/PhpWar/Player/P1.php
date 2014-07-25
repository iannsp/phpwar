<?php
namespace Iannsp\PhpWar\Player;
use Iannsp\PhpWar\Move as move;
use \Iannsp\PhpWar\Arena as Arena;

class P1 implements playerInterface
{
    private $arenaWidth  = 0;
    private $arenaHeight = 0;
    public function __construct($width, $height)
    {
        $this->arenaWidth  = $width;
        $this->arenaHeight = $height;
    }
    public function play()
    {
        $arenaHeight = $this->arenaHeight;
        $arenaWidth  = $this->arenaWidth;
       return new move(rand(0, $arenaHeight), rand(0,$arenaWidth)); 
    }
    
    public function feedback($status)
    {
     // use it to stat you play strategy.   
    }
}



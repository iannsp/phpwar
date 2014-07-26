<?php
namespace Iannsp\PhpWar\Player;
use Iannsp\PhpWar\Move as move;
use \Iannsp\PhpWar\Arena as Arena;

class P2 implements playerInterface
{
    private $arenaWidth  = 0;
    private $arenaHeight = 0;
    private $lasw = 0;
    private $lasH  = 0;
    public function __construct($width, $height)
    {
        $this->arenaWidth  = $width;
        $this->arenaHeight = $height;
    }
    public function play()
    {
        
        $arenaHeight = $this->arenaHeight;
        $arenaWidth  = $this->arenaWidth;
        $h = $this->lasH ;
        $this->lasW = $this->lasW +1;
        $w = $this->lasW;
        if ($this->lasW == $arenaHeight)
        {
            $this->lasH++;
            $this->lasW = 0;
        }
       return new move($h, $w); 
    }
    
    public function feedback($status)
    {
     // use it to stat you play strategy.   
    }
}



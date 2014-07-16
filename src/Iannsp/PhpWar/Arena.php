<?php
namespace Iannsp\PhpWar;
use \Iannsp\PhpWar\Move as Move;
class Arena
{
    private $dimension = array();
    private $arena = array();
    public function __construct($width=4, $height=4)
    {
        $this->dimension['width']  = $width;
        $this->dimension['height'] = $height;
        $this->bootstrap();
    }
    private function bootstrap()
    {
        for ($x=0; $x<$this->dimension['width']; $x++){
            for($y=0; $y< $this->dimension['height']; $y++)
                $this->arena[$x][$y]='.'; 
        }
    }
    public function getHeight()
    {
        return $this->dimension['height'];
    }

    public function getWidth()
    {
        return $this->dimension['width'];
    }
    public function setMove($id, Move $move)
    {
       $m = $move->getCoordenates();
       $this->arena[$m['x']][$m['y']]= $id; 
    }
    public function getArena()
    {
        return $this->arena;
    }
}

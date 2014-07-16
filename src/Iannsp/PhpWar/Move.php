<?php
namespace Iannsp\PhpWar;

class Move
{
    private $position = array('x'=>null, 'y'=>null); 
    public function __construct($x,$y)
    {
        $this->position = array('x'=>$x, 'y'=>$y);
    }
    public function getCoordenates()
    {
        return $this->position; 
    }
}

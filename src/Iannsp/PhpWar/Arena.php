<?php
namespace Iannsp\PhpWar;

use \Iannsp\PhpWar\Move as Move;
use Iannsp\PhpWar\Geometry;

class Arena
{
    private $dimension = null;
    private $arena = array();
    private $playAnalizes = array();

    public function __construct(Geometry\Cartesian\Point $arenaLimits, array $scoreStrategy = array())
    {
        $this->dimension = $arenaLimits;
        $this->playAnalizes = $scoreStrategy;
        $this->bootstrap();
    }

    private function bootstrap()
    {
        for ($x=0; $x<$this->dimension->getX(); $x++){
            for($y=0; $y< $this->dimension->getY(); $y++)
                $this->arena[$x][$y]='.';
        }
        foreach ($this->playAnalizes as $name=> $pAnalize){
            $this->playAnalizes[$name]= new $pAnalize($this);
        }
    }

    public function getLimits()
    {
        return $this->dimension;
    }

    public function setMove($id, Move $move)
    {  $result = true;
        foreach ($this->playAnalizes as $analize){
            if (!$analize->analyze($id, $move)){
                return false;
            }
        }
       $m = $move->getCoordenates();
       $this->arena[$m['x']][$m['y']]= $id;
       return true;
    }

    public function getArena()
    {
        return $this->arena;
    }

    public function stats()
    {
        $result = array();
        foreach($this->arena as $line){
            $values = array_count_values($line);
            foreach ($values as $id => $total){
                if (!array_key_exists($id, $result))
                    $result[$id]=0;
                $result[$id] += (int)$total;
            }
        }
        return $result;
    }
}

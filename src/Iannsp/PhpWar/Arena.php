<?php
namespace Iannsp\PhpWar;

use \Iannsp\PhpWar\Move as Move;
use Iannsp\PhpWar\Geometry;
use Iannsp\PhpWar\Game\Feedback;

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

    public function play($id, Move $move)
    {   $feedback = new Feedback();
        foreach ($this->playAnalizes as $analize){
            $result = $analize->analyze($id, $move);
            $feedback->merge(Feedback::WIN, $result->getWinners());
            $feedback->merge(Feedback::LOSE, $result->getLosers());
            $feedback->merge(Feedback::NEUTRALIZED, $result->getNeutralizeds());
        }
        foreach ($feedback->getWinners() as $winner){
            $m = $winner->getCoordenates();
            $this->arena[$m['x']][$m['y']]= $id;
        }
        foreach ($feedback->getNeutralizeds() as $neutralized){
            $m = $neutralized->getCoordenates();
            $this->arena[$m['x']][$m['y']]= '.';
        }
/*
       $m = $move->getCoordenates();
       $this->arena[$m['x']][$m['y']]= $id;
*/
       return $feedback;
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

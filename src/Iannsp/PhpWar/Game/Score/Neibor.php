<?php
namespace Iannsp\PhpWar\Game\Score;
use \Iannsp\PhpWar\Arena as Arena;
use Iannsp\PhpWar\Move as Move;
use Iannsp\PhpWar\Game\Feedback;

class Neibor
{
    private $arena;
    public function __construct($arena)
    {
        $this->arena = $arena;
    }
    public function analyze($playerName, Move $move)
    {
        $warPlace    = $this->arena->getArena();
        return $this->calculate($move, $warPlace, $playerName);
    }
    private function calculate($move, $warPlace, $playerName)
    {
        $coordinates = $move->getCoordenates();
        $x = $coordinates['x'];
        $y = $coordinates['y'];
            $feedback = new Feedback;
        $result = array(
            isset($warPlace[$x-1][$y+1]) ? $warPlace[$x-1][$y+1] : null, // left top corner
            isset($warPlace[$x][$y+1]) ? $warPlace[$x][$y+1] : null, // center top
            isset($warPlace[$x+1][$y+1]) ? $warPlace[$x+1][$y+1] : null, // right top
            isset($warPlace[$x-1][$y]) ? $warPlace[$x-1][$y] : null, // left same line
            isset($warPlace[$x+1][$y]) ? $warPlace[$x+1][$y] : null, // right same line
            isset($warPlace[$x-1][$y-1]) ? $warPlace[$x-1][$y-1] : null, // left bottom corner
            isset($warPlace[$x][$y-1]) ? $warPlace[$x][$y-1] : null, // center bootom
            isset($warPlace[$x+1][$y-1]) ? $warPlace[$x+1][$y-1] : null // right bottom
        );
//        foreach ($warPlace as $place){var_dump(implode('', $place));};
        $rEnd = array();
        foreach ($result as $idx=>$r){
            if (!is_null($r))
                $rEnd[] = $r;
        }
        $count = array_count_values($rEnd);
        asort($count);
        unset($count['.']);
        if (count($count)==0){
            $feedback->add(Feedback::WIN, $move);
            return $feedback;
        }
        $dominanteId    = key($count);
        $dominanteCount = array_shift($count);
        if ($dominanteId==$playerName || $dominanteId=='.'){
            $feedback->add(Feedback::WIN, $move);
            return $feedback;
        }
        if($dominanteCount ==1){
            $feedback->add(Feedback::WIN, $move);
            return $feedback;
        }

        $feedback->add(Feedback::LOSE, $move);
        return $feedback;
    }
}

/*
1,1 =
. . .
. 0 .
. . .
*/


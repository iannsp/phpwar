<?php
namespace Iannsp\PhpWar\Game;
use Iannsp\PhpWar\Move;

class Feedback
{

    const LOSE  =-1;
    const WIN   = 1;
    const NEUTRALIZED = 0;
    private $lose = array();
    private $win  = array();
    private $neutralized = array();
    public function add($status,  $move)
    {
        switch($status){
            case self::LOSE:
                $this->lose[]= $move;
                break;
            case self::WIN:
                $this->win[] = $move;
                break;
            case self::NEUTRALIZED:
            $this->neutralized[] = $move;
        }
    }
    public function getWinners()
    {
        return $this->win;
    }
    public function getLosers()
    {
        return $this->lose;
    }
    public function getNeutralizeds()
    {
        return $this->neutralized;
    }
    public function merge($status, array $moves){
        switch($status){
            case self::LOSE:
                $this->lose= array_merge($this->lose,$moves);
                break;
            case self::WIN:
                $this->win= array_merge($this->win,$moves);
                break;
            case self::NEUTRALIZED:
            $this->neutralized   = array_merge($this->neutralized,$moves);
        }
    }
}

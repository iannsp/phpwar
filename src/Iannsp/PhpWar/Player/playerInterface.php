<?php
namespace Iannsp\PhpWar\Player;

use Iannsp\PhpWar\Geometry\Cartesian;

interface PlayerInterface
{
    /**
     * @return \Iannsp\PhpWar\Move
     */
    public function play();
    /**
     *  True if win the position, false if lose.
     *  @return boolean
     */
    public function feedback($status);
}


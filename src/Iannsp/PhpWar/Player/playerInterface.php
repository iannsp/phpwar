<?php
namespace Iannsp\PhpWar\Player;

use Iannsp\PhpWar\Geometry\Cartesian;

interface playerInterface
{
    public function __construct(Cartesian\Point $arenaeLimits);
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


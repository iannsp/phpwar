<?php
/**
 * User: Jeremy
 * Date: 7/29/2014
 * Time: 3:04 AM
 */

namespace Iannsp\PhpWar\Player;


use Iannsp\PhpWar\Geometry\Cartesian;

class NullPlayer implements PlayerInterface {

    /**
     * @return \Iannsp\PhpWar\Move
     */
    public function play()
    {

    }

    /**
     *  True if win the position, false if lose.
     * @return boolean
     */
    public function feedback($status)
    {

    }
}
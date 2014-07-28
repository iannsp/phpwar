<?php
/**
 * User: Jeremy
 * Date: 7/28/2014
 * Time: 12:43 AM
 */

namespace Iannsp\PhpWar\Arena;


use Iannsp\PhpWar\Player\PlayerInterface;

interface AssetInterface
{
    /**
     * @return PlayerInterface
     */
    public function getOwner();

    /**
     * @return Coordinate
     */
    public function getCoordinate();
} 
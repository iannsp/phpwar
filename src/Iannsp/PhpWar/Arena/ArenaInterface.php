<?php
/**
 * User: Jeremy
 * Date: 7/27/2014
 * Time: 1:45 PM
 */

namespace Iannsp\PhpWar\Arena;


use Iannsp\PhpWar\Player\PlayerInterface;

interface ArenaInterface {
    /**
     * @return Axes
     */
    public function getAxes();

    /**
     * @param Coordinate $coordinate
     * @return AssetInterface[]
     */
    public function getNeighbors(Coordinate $coordinate);

    /**
     * @param PlayerInterface $player
     * @return mixed
     */
    public function countTerritory(PlayerInterface $player);
}
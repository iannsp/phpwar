<?php
/**
 * User: Jeremy
 * Date: 7/27/2014
 * Time: 11:56 PM
 */

namespace Iannsp\PhpWar\Arena;


use Iannsp\PhpWar\Player\PlayerInterface;

class Arena implements ArenaInterface
{
    /** @var  Axes */
    protected $axes;
    /** @var  array */
    protected $assets;

    function __construct($axes)
    {
        $this->axes = $axes;


    }

    /**
     * @return Axes
     */
    public function getAxes()
    {
        return $this->axes;
    }

    /**
     * @param Coordinate $coordinate
     * @return AssetInterface[]
     */
    public function getNeighbors(Coordinate $coordinate)
    {
        // TODO: Implement getNeighbors() method.
    }

    /**
     * @param PlayerInterface $player
     * @return mixed
     */
    public function countTerritory(PlayerInterface $player)
    {
        // TODO: Implement countTerritory() method.
    }


}
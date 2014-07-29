<?php
/**
 * User: Jeremy
 * Date: 7/29/2014
 * Time: 1:53 AM
 */

namespace Iannsp\PhpWar\Arena;


use Iannsp\PhpWar\Player\PlayerInterface;

class NullAsset implements AssetInterface {
    /** @var  Coordinate */
    protected $coordinate;
    /** @var  PlayerInterface */
    protected $owner;

    function __construct(Coordinate $coordinate, PlayerInterface $owner = null)
    {
        $this->coordinate = $coordinate;
        $this->owner = $owner;
    }

    /**
     * @return PlayerInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return Coordinate
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }
}
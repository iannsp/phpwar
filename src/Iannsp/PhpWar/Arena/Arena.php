<?php
/**
 * User: Jeremy
 * Date: 7/27/2014
 * Time: 11:56 PM
 */

namespace Iannsp\PhpWar\Arena;


use Iannsp\PhpWar\Player\PlayerInterface;
use SplObjectStorage;

class Arena implements ArenaInterface
{
    /** @var  Axes */
    protected $axes;
    /** @var  array */
    protected $assets;

    function __construct(Axes $axes)
    {
        $this->axes = $axes;
        $this->assets = array();
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
        $axes =array();
        foreach($coordinate as $axis)
        {
            $value = $coordinate[$axis];
            $axes[] = new Axis(new Bounds($value-1, $value+1));
        }
        /** @var AssetInterface[] $assets */
        $assets= new SplObjectStorage();
        $this->iterate(new Axes($axes), $assets, $this->assets);
        foreach($assets as $asset)
        {
            // don't include central coordinate
            if($asset->getCoordinate() == $coordinate)
            {
                $assets->detach($asset);
            }
        }

        return $assets;
    }

    /**
     * @param PlayerInterface $player
     * @return mixed
     */
    public function countTerritory(PlayerInterface $player)
    {
        $assets = new SplObjectStorage();
        /** @var AssetInterface[] $assets */
        $this->iterate(clone $this->getAxes(), $assets, $this->assets);

        $count = 0;
        foreach($assets as $asset)
        {
            if($asset->getOwner() === $player)
            {
                $count++;
            }
        }
        return $count;
    }

    /**
     * @param Axes $axes
     * @param SplObjectStorage $foundAssets
     * @param array $assetsSlice
     */
    protected function iterate(Axes $axes, SplObjectStorage &$foundAssets, &$assetsSlice)
    {
        if($axes->count() < 1)
        {
            return;
        }
        $axis = $axes->shift();

        foreach($axis as $index)
        {
            // if nothing has been defined in the plane, skip it
            if(!isset($assetsSlice[$index]))
            {
                continue;
            }
            // if there are no more axes left, this is the terminal dimension
            if($axes->count() < 1)
            {
                // get the asset at the terminal position
                $foundAssets->attach($assetsSlice[$index]);
            } else {
                // traverse next dimension
                $this->iterate(clone $axes, $foundAssets, $assetsSlice[$index]);
            }
        }
    }

    /**
     * @param Coordinate $coordinate
     * @return null
     */
    public function getAsset(Coordinate $coordinate)
    {
        $r = & $this->assets;
        foreach($coordinate as $axis)
        {
            $value = $coordinate[$axis];
            if(!isset($r[$value]))
            {
                return null;
            }
            $r = & $r[$value];
        }
        return $r;
    }

    /**
     * @param Coordinate $coordinate
     * @param AssetInterface $asset
     */
    public function setAsset(Coordinate $coordinate, AssetInterface $asset)
    {
        $r = & $this->assets;
        foreach($coordinate as $i => $axis)
        {
            $value = $coordinate[$axis];

            if($i == count($coordinate)-1)
            {
                $r[$value] = $asset;
                break;
            }

            if(!isset($r[$value]))
            {
                $r[$value] = array();
            }
            $r = & $r[$value];
        }
    }

    /**
     * @return array
     */
    public function getAssets()
    {
        return $this->assets;
    }

}
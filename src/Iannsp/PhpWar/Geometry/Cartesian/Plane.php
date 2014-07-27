<?php

namespace Iannsp\PhpWar\Geometry\Cartesian;

class Plane implements \Countable
{
    private $limits = null;
    private $points;

    public function __construct($xLimit, $yLimit)
    {
        $this->limits = new Point($xLimit, $yLimit);
        $this->points = new \SplObjectStorage();
    }

    public function getLimits()
    {
        return $this->limits;
    }

    public function count($mode = \COUNT_NORMAL)
    {
        return count($this->points, $mode);
    }

    public function addPoint(Point $newPoint)
    {
        $this->points->attach($newPoint);
    }

    public function hasPoint(Point $searchPoint)
    {
        $foundPoint = $this->getPoint($searchPoint->getX(), $searchPoint->getY());

        return ($foundPoint instanceof Point);
    }

    public function getPoint($x, $y)
    {
        $searchPoint = new Point($x, $y);
        foreach ($this->points as $point) {
            if ($point == $searchPoint) {
                return $point;
            }
        }

        return null;
    }
}

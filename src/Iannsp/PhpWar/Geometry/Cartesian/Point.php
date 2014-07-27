<?php

namespace Iannsp\PhpWar\Geometry\Cartesian;

class Point
{
    private $x = null;
    private $y = null;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }
}

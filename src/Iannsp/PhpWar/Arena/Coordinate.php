<?php
/**
 * User: Jeremy
 * Date: 7/27/2014
 * Time: 11:58 PM
 */

namespace Iannsp\PhpWar\Arena;


use SplObjectStorage;

class Coordinate extends SplObjectStorage {

    /**
     * @param Axes $axes
     * @param ... values for specified axes in order axis appears in $axes parameter. Missing values default to 0
     */
    function __construct(Axes $axes)
    {
        foreach($axes as $i => $axis)
        {
            $value = func_get_arg($i+1) ?: 0;
            $this->attach($axis, $value);
        }
    }

    /**
     * @param Axis $axis
     * @param int $translation
     * @return Coordinate a new coordinate representing the translated coordinate
     */
    public function translate(Axis $axis, $translation)
    {
        /** @var SplObjectStorage $coordinate */
        $coordinate = clone $this;
        $coordinate[$axis] = $coordinate[$axis] + $translation;
        return $coordinate;
    }

    public function __toString()
    {
        $values = array();
        foreach($this as $axis)
        {
            $values[] = $this[$axis];
        }
        return sprintf('(%s)', join(',', $values));
    }
}
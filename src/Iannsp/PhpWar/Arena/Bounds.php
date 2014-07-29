<?php
/**
 * User: Jeremy
 * Date: 7/27/2014
 * Time: 1:36 PM
 */

namespace Iannsp\PhpWar\Arena;


use InvalidArgumentException;

class Bounds {
    /** @var  int */
    protected $min;
    /** @var  int */
    protected $max;

    /**
     * @param $max int
     * @param $min int
     */
    function __construct($min, $max)
    {
        if((int)$min > (int)$max)
        {
            throw new InvalidArgumentException("Min value must be less than Max value");
        }
        $this->setMax($max);
        $this->setMin($min);
    }


    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $max
     */
    public function setMax($max)
    {
        $this->max = (int)$max;
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin($min)
    {
        $this->min = (int)$min;
    }



} 
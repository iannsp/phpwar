<?php
/**
 * User: Jeremy
 * Date: 7/27/2014
 * Time: 1:36 PM
 */

namespace Iannsp\PhpWar\Arena;


use Iterator;

class Axis implements Iterator {
    /** @var  int */
    protected $iteratorCurrent;
    /** @var  Bounds */
    protected $bounds;

    function __construct(Bounds $bounds)
    {
        $this->setBounds($bounds);
    }

    /**
     * @return Bounds
     */
    public function getBounds()
    {
        return $this->bounds;
    }

    /**
     * @param Bounds $bounds
     */
    public function setBounds(Bounds $bounds)
    {
        $this->bounds = $bounds;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->iteratorCurrent;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->iteratorCurrent++;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->iteratorCurrent;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return $this->getBounds()->getMin() <= $this->iteratorCurrent
            && $this->iteratorCurrent <= $this->getBounds()->getMax();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->iteratorCurrent = $this->getBounds()->getMin();
    }
}
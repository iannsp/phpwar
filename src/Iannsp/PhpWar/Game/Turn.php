<?php

namespace Iannsp\PhpWar\Game;

class Turn implements \Iterator, \Countable, \SplSubject
{
    const DEFAULT_TURN_LIMIT = 100;

    private $currentTurn = null;
    private $turnLimit = null;
    private $observers = null;

    public function __construct($turnLimit = self::DEFAULT_TURN_LIMIT)
    {
        $this->turnLimit = (int) $turnLimit;
        $this->observers = new \SplObjectStorage();
    }

    public function current()
    {
        $this->notify();

        return $this->currentTurn;
    }

    public function next()
    {
        $this->currentTurn++;
    }

    public function key()
    {
        return $this->current();
    }

    public function rewind()
    {
        $this->currentTurn = 1;
    }

    public function valid()
    {
        if ($this->currentTurn >= $this->turnLimit) {
            return false;
        }

        return true;
    }

    public function count($mode = \COUNT_NORMAL)
    {
        return $this->current();
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

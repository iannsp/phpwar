<?php
namespace Iannsp\PhpWar\Player;
use \Iannsp\PhpWar\Arena as Arena;
interface playerInterface
{
    public function __construct(Arena $arena);
/**
* @return \Iannsp\PhpWar\Move
*/
    public function play();
}


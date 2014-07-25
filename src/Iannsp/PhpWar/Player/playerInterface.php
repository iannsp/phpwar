<?php
namespace Iannsp\PhpWar\Player;
use \Iannsp\PhpWar\Arena as Arena;
interface playerInterface
{
    public function __construct($width, $height);
/**
* @return \Iannsp\PhpWar\Move
*/
    public function play();
}


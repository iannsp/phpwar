phpwar
======

Code War php

     <?php
    $arena = new Iannsp\PhpWar\Arena(10,10);
    $players = array (
    new Iannsp\PhpWar\Player\P1($arena->getWidth(), $arena->getHeight()),
    new Iannsp\PhpWar\Player\P1($arena->getWidth(), $arena->getHeight())
    );
    $game = new Iannsp\PhpWar\Game($arena, $players);
    $moves=0;
    while($moves < 100){
        $game->round();
        $moves++;
    }
    ?>

<pre>
 0  .  1  .  1  1  0  1  0  0 
 0  1  0  1  .  0  1  1  0  1 
 .  .  .  0  1  1  1  0  1  . 
 0  1  0  1  1  .  0  1  0  1 
 0  0  .  1  0  1  .  1  .  . 
 1  1  0  1  .  1  1  0  1  1 
 .  .  1  1  1  0  1  1  0  1 
 1  1  0  1  0  0  1  1  0  . 
 .  1  .  .  .  1  0  1  1  1 
 1  .  .  1  0  0  .  1  1  1 
</pre>    
<?php
require 'bootstrap.php';

$scoreStrategy = array(
    'Hit'=>'\\Iannsp\PhpWar\\Game\\Score\\Hit',
    'Neibor'=>'\\Iannsp\PhpWar\\Game\\Score\\Neibor',
);
$arenaLimits = new Iannsp\PhpWar\Geometry\Cartesian\Point(10,10);
$arena = new Iannsp\PhpWar\Arena($arenaLimits, $scoreStrategy);
$players = array (
new Iannsp\PhpWar\Player\P1($arenaLimits),
new Iannsp\PhpWar\Player\P2($arenaLimits)
);
$game = new Iannsp\PhpWar\Game($arena, $players);

function render($game, $arena, $players)
{
   $w = $arena->getLimits()->getX();
   $h = $arena->getLimits()->getY();
   $arenaArray = $arena->getArena();
print chr(27) . "[2J" . chr(27) . "[;H";
   for ($x = 0; $x<$w; $x++)
   {
        for ($y=0; $y < $h; $y++)
        {
            echo " ".($arenaArray[$x][$y])." ";
        }
        echo "\n";
   }
}


echo "runing a game\n";
foreach ($game as $currentTurn) {
    render($game, $arena, $players);
}

echo "
    _____  _    _ _____   __          __
   |  __ \| |  | |  __ \  \ \        / /
   | |__) | |__| | |__) |  \ \  /\  / /_ _ _ __
   |  ___/|  __  |  ___/    \ \/  \/ / _` | '__|
   | |    | |  | | |         \  /\  / (_| | |
   |_|    |_|  |_|_|          \/  \/ \__,_|_|

    \nResult\n";
$stats = $arena->stats();
foreach ($stats as $id=>$stat){
    if ($id!=='.')
    echo "Player {$id} has {$stat} position(s).\n";
}

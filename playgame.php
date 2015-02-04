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
new Iannsp\PhpWar\Player\P1($arenaLimits)
);
$game = new Iannsp\PhpWar\Game($arena, $players);

$frameRate = 4;

foreach ($game as $currentTurn) {
    print $game->render($frameRate);
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

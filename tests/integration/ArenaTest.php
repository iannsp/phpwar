<?php
namespace Iannsp\PhpWar;

class ArenaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function arena_limits_are_the_same_passed_on_instantiation()
    {
        $width = 4;
        $height= 3;
        $arenaLimits = new Geometry\Cartesian\Point($width, $height);
        $arena = new Arena($arenaLimits);

        $this->assertSame(
            $arenaLimits,
            $arena->getLimits()
        );

    }

    /**
     * @test
     * @depends arena_limits_are_the_same_passed_on_instantiation
     * @TODO Rename Method: `getArena` is better explained as `getTilesAsMatrix`.
     */
    public function arena_tiles_can_be_returned_and_inpected()
    {
        $arenaLimits = new Geometry\Cartesian\Point(4, 4);
        $arena = new Arena($arenaLimits);

        $tiles = $arena->getArena();
        $this->assertCount(
            4,
            $tiles,
            'Number of rows (y-axis) in the arena does not match the arena limits.'
        );
        $this->assertCount(
            4,
            $tiles[0],
            'Number of columns (x-axis) in the first arena row (y-axis) does not match the arena limits.'
        );

        foreach ($tiles as $lines) {
            $contentsOfRow = array_unique($lines);
            $this->assertEquals(
                '.',
                implode('', $contentsOfRow),
                'Contents of the row should be empty.'
            );
        }
    }

    /**
     * @test
     * @depends arena_tiles_can_be_returned_and_inpected
     * @TODO Extract Class: `stats` should belong to its own class.
     */
    public function new_game_should_contain_only_empty_tiles()
    {
        $arenaLimits = new Geometry\Cartesian\Point(4, 4);
        $arena = new Arena($arenaLimits);

        $stats = $arena->stats();
        $this->assertCount(
            1,
            $stats,
            'Status of the game should only contain one information: the number of empty tiles.'
        );
        $this->assertArrayHasKey(
            '.',
            $stats,
            'The number of empty tiles identifier should be an index of the array returned on the game status.'
        );
        $this->assertContains(
            16,
            $stats,
            'Number of emtpy tiles should be the total available positions on the arena (cartesian plane).'
        );
    }

    /**
     * @test
     * @depends arena_tiles_can_be_returned_and_inpected
     * @depends new_game_should_contain_only_empty_tiles
     * @TODO Rename Method: `play` is better explained as `setPointContent`.
     * @TODO Extract Method: `setPointContent` should belongs to Cartesian\Plane.
     */
    public function occupation_of_a_tile_on_a_rulesless_game()
    {
        $arenaLimits = new Geometry\Cartesian\Point(4, 4);
        $scoreStrategy = array(
            'Hit'=>'\\Iannsp\PhpWar\\Game\\Score\\Neibor'
        );
        $arena = new Arena($arenaLimits, $scoreStrategy);
        $tileToBeOccupied = new Move(0,1);
        $alice = 'A';

        $arena->play($alice, $tileToBeOccupied);
        $gameCurrentStatus = $arena->stats();
        $this->assertCount(
            2,
            $gameCurrentStatus,
            'Status of the game should return two information: empty tiles and Alice\'s tiles.'
        );
        $this->assertArrayHasKey(
            '.',
            $gameCurrentStatus,
            'The number of empty tiles identifier should be an index of the array returned on the game status.'
        );
        $this->assertArrayHasKey(
            $alice,
            $gameCurrentStatus,
            'The number of Alice\'s tiles identifier should be an index of the array returned on the game status.'
        );
        $this->assertEquals(
            15,
            $gameCurrentStatus['.'],
            'Number of empty tiles should be the total of tiles available, minus Alice\'s tile (taken from her previous move).'
        );
        $this->assertEquals(
            1,
            $gameCurrentStatus[$alice],
            'Alice\'s owned tiles should be, since she made only one move.'
        );
    }

    /**
     * @test
     * @depends arena_tiles_can_be_returned_and_inpected
     * @depends occupation_of_a_tile_on_a_rulesless_game
     */
    public function position_already_occupied_is_neutralized_when_other_player_tried_to_occupy_it()
    {
        $rules = array(
            'Hit' => 'Iannsp\\PhpWar\\Game\\Score\\Hit'
        );
        $arenaLimits = new Geometry\Cartesian\Point(4, 4);
        $arena = new Arena($arenaLimits, $rules);
        $disputedTile = new Move(0,1);
        $alice = 'A';
        $bob = 'B';

        $arena->play($alice, $disputedTile);
        $tiles = $arena->getArena();
        $this->assertEquals(
            $alice,
            $tiles[0][1],
            'Alice should be occupying the tile where she moved in.'
        );

        $arena->play($bob, $disputedTile);
        $tiles = $arena->getArena();
        $this->assertEquals(
            '.',
            $tiles[0][1],
            'Bob should be neutralized the tile, as he moved there after Alice.'
        );
    }

    /**
     * @test
     * @depends arena_tiles_can_be_returned_and_inpected
     * @depends new_game_should_contain_only_empty_tiles
     * @depends position_already_occupied_is_neutralized_when_other_player_tried_to_occupy_it
     */
    public function rule_of_hit_is_applied_allowing_an_occupied_tile_to_be_taken_by_another_player()
    {
        $arenaLimits = new Geometry\Cartesian\Point(4, 4);
        $rules = array(
            'Hit' => 'Iannsp\\PhpWar\\Game\\Score\\Hit'
        );
        $arena = new Arena($arenaLimits, $rules);
        $move  = new Move(0,1);
        $alice = 'A';
        $bob = 'B';

        $arena->play($alice,$move);
        $tiles = $arena->getArena();
        $this->assertEquals(
            $alice,
            $tiles[0][1],
            'Alice moved to that tile, so it should be hers.'
        );

        $arena->play($bob,$move);
        $tiles = $arena->getArena();
        $this->assertEquals(
            '.',
            $tiles[0][1],
            'Bob moved to the tile occipied by Alice, therefore it is neutralized now.'
        );
    }

    /**
     * @test
     * @depends arena_tiles_can_be_returned_and_inpected
     * @depends new_game_should_contain_only_empty_tiles
     * @depends occupation_of_a_tile_on_a_rulesless_game
     * @TODO Move Method: This belongs to Neighbour test.
     */
    public function rule_of_neighbours_are_applied()
    {
        $arenaLimits = new Geometry\Cartesian\Point(4, 4);
        $rules = array(
            'Neibor' => 'Iannsp\\PhpWar\\Game\\Score\\Neibor'
        );
        $arena = new Arena($arenaLimits, $rules);
        $alice = 'A';
        $bob = 'B';

        $this->assertCount(1,
            $arena->play($alice, new Move(0,1))->getWinners(),
            'Alice should be able to move to an uncoppied tile.'
        );
        $this->assertCount(1,
            $arena->play($alice,new Move(1,1))->getWinners(),
            'Alice should be able to move to an uncoppied tile.'
        );
        $this->assertCount(1,
            $arena->play($alice,new Move(1,0))->getWinners(),
            'Alice should be able to move to an uncoppied tile.'
        );

        $this->assertCount(1,
            $arena->play($bob,new Move(0,0))->getLosers(),
            'Bob can\'t move to an unocoppied tile where Alice is a nighbour. He got shot in tha face!'
        );
        $this->assertCount(1,
            $arena->play($bob,new Move(1,1))->getLosers(),
            'Bob could occupy Alice\'s tile if it had no hostile (Alice\'s) nieghbours. He got shot in tha face, again!'
        );
    }
}

/*
,
        'Neibor'=>'\\Iannsp\PhpWar\\Game\\Score\\Neibor',
*/

<?php

namespace Iannsp\PhpWar\Game;

class TurnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function iteration_increases_turn()
    {
        $turns = new Turn;
        $this->assertInstanceOf(
            'Iterator',
            $turns,
            'Turn should implement Iterator.'
        );
        $this->assertCount(
            0,
            $turns,
            'No turn run, turn should be 0 (zero).'
        );
        foreach ($turns as $turn) {
            $this->assertEquals(
                1,
                $turn,
                'Content returned by turn iteration should be current turn number.'
            );
            break;
        }
        $this->assertCount(
            1,
            $turns,
            'After 1 (one) iteration, turn count should be 1.'
        );
    }

    /**
     * @test
     * @depends iteration_increases_turn
     */
    public function iteration_limited_to_default_value()
    {
        $turns = new Turn;
        foreach ($turns as $turn) {
            // Silence is golden.
        }

        $this->assertCount(
            Turn::DEFAULT_TURN_LIMIT,
            $turns,
            'Last turn should be default limit of turns after iteration.'
        );
    }

    /**
     * @test
     * @depends iteration_increases_turn
     */
    public function allows_attachament_of_observer()
    {
        $turns = new Turn;
        $observer = $this->getMockForAbstractClass('SplObserver');
        $observer->expects($this->exactly(Turn::DEFAULT_TURN_LIMIT-1))
            ->method('update')
            ->with($turns);

        $turns->attach($observer);
        foreach ($turns as $turn) {
            // Fuck. The. Police.
        }
    }
}

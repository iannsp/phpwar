<?php

namespace Iannsp\PhpWar\Game;
use Iannsp\PhpWar\Move;
class FeedbackTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function a_winner_feedback()
    {
        $feedback = new Feedback();
        $feedback->add(Feedback::WIN, new move(1,1));
        $feedback->add(Feedback::WIN, new move(0,1));
        $this->assertCount(2, $feedback->getWinners());
        $this->assertCount(0, $feedback->getLosers());
        $this->assertCount(0, $feedback->getNeutralizeds());
    }

    /**
     * @test
     */
    public function a_loser_feedback()
    {
        $feedback = new Feedback();
        $feedback->add(Feedback::LOSE, new move(1,1));
        $feedback->add(Feedback::LOSE, new move(0,1));
        $this->assertCount(0, $feedback->getWinners());
        $this->assertCount(2, $feedback->getLosers());
        $this->assertCount(0, $feedback->getNeutralizeds());
    }

    /**
     * @test
     */
    public function a_neutralized_feedback()
    {
        $feedback = new Feedback();
        $feedback->add(Feedback::NEUTRALIZED, new move(1,1));
        $feedback->add(Feedback::NEUTRALIZED, new move(0,1));
        $this->assertCount(0, $feedback->getWinners());
        $this->assertCount(0, $feedback->getLosers());
        $this->assertCount(2, $feedback->getNeutralizeds());
    }
}

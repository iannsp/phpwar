<?php

namespace Iannsp\PhpWar\Geometry\Cartesian;

class PlaneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function axis_limits_defined_on_instantiation()
    {
        $x = 10;
        $y = $x;
        $plane = new Plane($x, $y);

        $limits = $plane->getLimits();
        $this->assertEquals(
            $x,
            $limits->getX(),
            'Expected different value for X.'
        );
        $this->assertEquals(
            $y,
            $limits->getY(),
            'Expected different value for Y.'
        );
    }

    /**
     * @test
     */
    public function points_can_be_added_on_plane_can_be_counted()
    {
        $point = new Point(1,1);
        $plane = new Plane(10,10);

        $this->assertCount(
            0,
            $plane,
            'Plane should not have any objects added to it.'
        );

        $plane->addPoint($point);
        $this->assertCount(
            1,
            $plane,
            'Plane should have a point in it.'
        );
    }

    /**
     * @test
     * @depends points_can_be_added_on_plane_can_be_counted
     */
    public function points_added_can_be_retrieved_from_plane()
    {
        $point = new Point(1,1);
        $plane = new Plane(10,10);

        $plane->addPoint($point);

        $this->assertSame(
            $point,
            $plane->getPoint(1,1),
            'Point returned by plane should be the same one added.'
        );
        $this->assertTrue(
            $plane->hasPoint($point),
            'Plane should have previously added point.'
        );
        $this->assertTrue(
            $plane->hasPoint(new Point(1,1)),
            'Plane should have point previously added, but searched through a different object.'
        );
    }

    /**
     * @test
     * @depends points_added_can_be_retrieved_from_plane
     */
    public function points_that_doesnt_exist_on_plane_cannot_be_retrieved()
    {
        $plane = new Plane(10,10);

        $this->assertFalse(
            $plane->hasPoint(new Point(2,2)),
            'Plane should not have a plane which hasn\'t been added.'
        );
    }
}

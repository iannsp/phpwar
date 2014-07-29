<?php
/**
 * User: Jeremy
 * Date: 7/29/2014
 * Time: 1:35 AM
 */
namespace Iannsp\PhpWar\Arena;

use Iannsp\PhpWar\Player\NullPlayer;
use Iannsp\PhpWar\Player\P1;
use PHPUnit_Framework_TestCase;
use SplObjectStorage;

class ArenaTest extends PHPUnit_Framework_TestCase
{
    /** @var  Arena */
    protected $arena;

    protected function setUp()
    {
        parent::setUp();
        $this->arena = new Arena(new Axes(array(
            new Axis(new Bounds(0, 10)),
            new Axis(new Bounds(0, 10)),
            new Axis(new Bounds(0, 10))
        )));
    }

    /**
     * @param Axis $axis
     * @return int
     */
    protected function randomAxisPosition(Axis $axis, $buffer = 0)
    {
        return rand($axis->getBounds()->getMin()+$buffer, $axis->getBounds()->getMax()-$buffer);
    }


    public function testSetAssetInitializesArrayAsItTraverses()
    {
        $axes = $this->arena->getAxes();
        $x = $this->randomAxisPosition($axes[0]);
        $y = $this->randomAxisPosition($axes[1]);
        $z = $this->randomAxisPosition($axes[2]);

        $coordinate = new Coordinate($this->arena->getAxes(), $x, $y, $z);
        $asset = new NullAsset($coordinate, null);
        $this->assertEmpty($this->arena->getAssets());
        $this->arena->setAsset($coordinate, $asset);
        $assets = $this->arena->getAssets();
        $this->assertInternalType('array', $assets);
        $this->assertInternalType('array', $assets[$x]);
        $this->assertInternalType('array', $assets[$x][$y]);
        $this->assertEquals($asset, $assets[$x][$y][$z]);
    }

    /**
     * @depends testSetAssetInitializesArrayAsItTraverses
     */
    public function testGetAssetReturnsAssetAtCoordinateIfItExists()
    {
        $axes = $this->arena->getAxes();
        $x = $this->randomAxisPosition($axes[0]);
        $y = $this->randomAxisPosition($axes[1]);
        $z = $this->randomAxisPosition($axes[2]);

        $coordinate = new Coordinate($this->arena->getAxes(), $x, $y, $z);
        $asset = new NullAsset($coordinate, null);
        $this->assertEmpty($this->arena->getAssets());
        $this->arena->setAsset($coordinate, $asset);
        $this->assertEquals($asset, $this->arena->getAsset($coordinate));
    }

    public function testGetAssetReturnsNullIfNoneExistsAtCoordinate()
    {
        $axes = $this->arena->getAxes();
        $x = $this->randomAxisPosition($axes[0]);
        $y = $this->randomAxisPosition($axes[1]);
        $z = $this->randomAxisPosition($axes[2]);

        $coordinate = new Coordinate($this->arena->getAxes(), $x, $y, $z);
        $this->assertNull($this->arena->getAsset($coordinate));
    }

    public function testCountTerritory()
    {
        /** @var NullPlayer[] $players */
        $players = array(new NullPlayer(), new NullPlayer(), new NullPlayer());
        $playerCount = new SplObjectStorage();
        $axes = $this->arena->getAxes();

        foreach($players as $player)
        {
            $count = rand(1,3);
            $playerCount->attach($player, 0);

            for($i = $count; $i > 0; $i--)
            {
                $x = $this->randomAxisPosition($axes[0]);
                $y = $this->randomAxisPosition($axes[1]);
                $z = $this->randomAxisPosition($axes[2]);

                $coordinate = new Coordinate($this->arena->getAxes(), $x, $y, $z);
                if($this->arena->getAsset($coordinate))
                {
                    continue;
                }
                $asset = new NullAsset($coordinate, $player);
                $this->arena->setAsset($coordinate, $asset);
                $playerCount[$player] = $playerCount[$player]+1;
            }

        }

        foreach($players as $player)
        {
            $count = $this->arena->countTerritory($player);
            $this->assertEquals($playerCount[$player], $count);
        }
    }

    /**
     * @group GetNeighbors
     */
    public function testGetNeighbors()
    {
        $axes = $this->arena->getAxes();
        $x = $this->randomAxisPosition($axes[0], 2);
        $y = $this->randomAxisPosition($axes[1], 2);
        $z = $this->randomAxisPosition($axes[2], 2);

        $coordinate = new Coordinate($this->arena->getAxes(), $x, $y, $z);
        $this->arena->setAsset($coordinate, $n0 = new NullAsset($coordinate, null));
        // neighbors
        $c1 = $coordinate->translate($axes[0], -1);
        $c2 = $coordinate->translate($axes[1], 1);
        $c3 = $coordinate->translate($axes[2], 1);

        $this->arena->setAsset($c1, $n1 = new NullAsset($c1, null));
        $this->arena->setAsset($c2, $n2 = new NullAsset($c2, null));
        $this->arena->setAsset($c3, $n3 = new NullAsset($c3, null));
        // not neighbor
        $c4 = $coordinate->translate($axes[1], 4);
        $this->arena->setAsset($c4, new NullAsset($c4, null));

        $this->assertCount(3, $neighbors = $this->arena->getNeighbors($coordinate));
        $this->assertContains($n1, $neighbors);
        $this->assertContains($n2, $neighbors);
        $this->assertContains($n3, $neighbors);
        $this->assertNotContains($n0, $neighbors);
    }
}
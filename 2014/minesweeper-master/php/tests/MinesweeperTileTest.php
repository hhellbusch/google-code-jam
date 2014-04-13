<?php

include_once('MinesweeperTile.php');

class MinesweeperTileTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function testTileDoesNotHaveMineOnInit()
	{
		$tile = new MinesweeperTile();
		$this->assertFalse($tile->hasMine(), "tile should not have mine on construct");
	}

	public function testTileIsNotFlippedOnInit()
	{
		$tile = new MinesweeperTile();
		$this->assertFalse($tile->hasBeenFlipped(), "tile should not be flipped on construct");
	}

	public function testTileIsNotClickedOnInit()
	{
		$tile = new MinesweeperTile();
		$this->assertFalse($tile->hasBeenFlipped(), "tile should not be clicked on construct");
	}

	
}

<?php

include_once('MinesweeperBoard.php');

class MinesweeperBoardTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function testInit()
	{
		$board = new MinesweeperBoard(4, 5);
		$boardDataStructure = $board->getBoardDataStructure();
		$this->assertCount(4, $boardDataStructure, 'board should have 4 cols');
		foreach ($boardDataStructure as $row)
		{
			$this->assertCount(5, $row, 'board should have 5 rows');
		}
	}

	public function testClone()
	{
		$board = new MinesweeperBoard(2,3);
		$originalTiles = $board->getBoardDataStructure();
		$clone = clone $board;
		$this->assertNotSame($board, $clone);
		$cloneTiles = $clone->getBoardDataStructure();

		foreach ($cloneTiles as $x => $row)
		{
			foreach ($row as $y => $tile) 
			{
				$this->assertNotSame($tile, $originalTiles[$x][$y]);
			}
		}
	}

	public function testToString()
	{
		$board = new MinesweeperBoard(1,3);
		$string = $board->__toString();
		$expected = ".\n.\n.\n";
		$this->assertEquals($expected, $string);
	}
}

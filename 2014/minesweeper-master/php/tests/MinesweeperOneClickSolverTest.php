<?php

include_once('MinesweeperOneClickSolver.php');

class MinesweeperOneClickSolverTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function testNothing()
	{
		$solver = new MinesweeperOneClickSolver($numMines = 2, $x = 3, $y = 2);
		$this->assertTrue(true);
	}

	
}

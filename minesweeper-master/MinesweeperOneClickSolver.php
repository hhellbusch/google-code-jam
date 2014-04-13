<?php

/**
 * completed for google jam 2014
 * problem c: minesweeper master
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

include_once('MinesweeperBoard.php');

class MinesweeperOneClickSolver
{
	private $board;

	public function __construct($numMines, $numRows, $numCols)
	{
		$this->board = new MinesweeperBoard($numRows, $numCols);
		
		//can fill the board in any manner we want 
		//$this->spiralFill($numRows, $numCols,$numMines);
		$this->buildBoards();
		
		if ($numMines != $this->board->getMineCount())
		{
			throw new Exception("failed to init the board properly");
		}
	}

	private function buildBoards($numRows, $numCols, $numMines)
	{
		
	}

	// private function smartFill($numRows, $numCols, $numMines)
	// {
	// 	$minesPlaced = 0;
	// 	$x = 0;
	// 	$y = 0;
	// 	while ($minesPlaced < $numMines)
	// 	{
	// 		//completely fill the row if possible
	// 		if ($numMines - $minesPlaced > $)
	// 		{
	// 			$this->board->setMineAt($x, $y);
	// 			$minesPlaced++;
	// 			$x++;
	// 		}
			

			
	// 	}
	// }

	//doesn't work 100% of time
	private function spiralFill($numRows, $numCols, $numMines)
	{
		$spiralCount = 0;
		$x = 0;
		$y = 0;
		$minesPlaced = 0;
		while ($minesPlaced < $numMines)
		{
			//fill in from the top of the board left to right
			$this->board->setMineAt($x, $y);
			$minesPlaced++;
			$x++;
			//if at the end of the row
			if ($x == ($numCols - $spiralCount))
			{
				$x--;
				//at the top, fill in from top to bottom
				while(
					(($y + ($spiralCount + 1)) < $numRows) 
					&& $minesPlaced < $numMines
				) {
					$y++;
					$this->board->setMineAt($x, $y);
					$minesPlaced++;
				}
				//at the right bottom corner, fill in from right to left
				while ($x > $spiralCount && $minesPlaced < $numMines)
				{
					$x--;
					$this->board->setMineAt($x, $y);
					$minesPlaced++;
				}
				//at the left bottom corner, fill in from bottom to top
				while ($y > ($spiralCount + 1) && $minesPlaced < $numMines)
				{
					$y--;
					$this->board->setMineAt($x, $y);
					$minesPlaced++;
				}
				$spiralCount++;
				$x = $spiralCount;
				$y = $spiralCount;
			}

		}
	}

	public function solveWithOneClick()
	{
		$solved = false;
		foreach ($this->boards as $board) 
		{
			$possibleClickSolutions = $board->getCoordsWithNoMinedNeighbors();
		
			foreach ($possibleClickSolutions as $clickLocation)
			{
				$copyOfBoard = clone $board;
				$copyOfBoard->clickAt($clickLocation['x'], $clickLocation['y']);
				$solved = $copyOfBoard->isSolved();
				if ($solved) {
					$copyOfBoard->display();
					break;
				}
			}
			if ($solved) break;
		}
		if ( ! $solved) 
		{
			echo 'Impossible' . "\n";
		}
	}



}

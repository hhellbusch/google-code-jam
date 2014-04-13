<?php

/**
 * completed for google jam 2014
 * problem c: minesweeper master
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

include_once('MinesweeperBoard.php');

class MinesweeperOneClickSolver
{
	private $boards = array();

	public function __construct($numMines, $numCols, $numRows)
	{
		//can fill the board in any manner we want 
		//$this->spiralFill($numRows, $numCols,$numMines);
		echo "building boards....\n";
		$this->naiveBuildBoards($numCols, $numRows, $numMines);
		
		foreach ($this->boards as $board) 
		{
			if ($numMines != $board->getMineCount())
			{
				throw new Exception("failed to init the board properly");
			}
		}
		
	}

	private function naiveBuildBoards($numCols, $numRows, $numMines)
	{
		$k = $numMines;
		$n = ($numRows * $numCols);
		
		$combinations = function($n, $k){
			$bcfact = function($in){
				// 0! = 1! = 1
				$out = 1;

				// Only if $in is >= 2
				for ($i = 2; $i <= $in; $i++) {
					$out = bcmul($out, $i);
				}
				return $out;
			};
			return $bcfact($n) / ($bcfact(($n - $k)) * $bcfact($k));
		};

		$numPossibleBoards = $combinations($n, $k);
		echo "possible number of boards: " . $numPossibleBoards . "\n";

		$oneDimBoards = array();
		$max = pow(2,$n);
		$ones = "";
		for ($i = 0; $i < $numMines; $i++)
		{
			$ones .= "1";
		}
		for ($i = 0; $i < $max; $i++)
		{
			$value = str_split(decbin ($i));
			$arrayCountValues = array_count_values($value);
			if (
				isset($arrayCountValues[1]) && $arrayCountValues[1] != $numMines
				|| ! isset($arrayCountValues[1])
			){
				continue;
			}

			while (count($value) < $n) {
				array_unshift($value, 0);
			}

			$oneDimBoards[] = $value;
			//a little bit of smartness to stop computing possible boards
			if (strpos($ones, implode($value)) == 0) {
				break;
			}
		}
		
		$boards = array();
		
		foreach ($oneDimBoards as $key=>$board) 
		{
			$boardObj = new MinesweeperBoard($numCols, $numRows);
			$x = 0;
			$y = 0;
			foreach ($board as $index => $tile) 
			{
				if ($tile == 1) 
				{
					$boardObj->setMineAt($x, $y);
				}
				$x++;
				if ($x >= $numCols)
				{
					$x = 0;
					$y++;
				}
			}
		}
		// if (count($oneDimBoards) != $numPossibleBoards)
		// {
		// 	throw new Exception("didn't make enough boards?");
		// }
		return $boards;
	}




	//doesn't work 100% of time
	private function spiralFill($numCols, $numRows, $numMines)
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
		echo "checking " . count($this->boards) . "\n";
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

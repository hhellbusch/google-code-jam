<?php

/**
 * completed for google jam 2014
 * problem c: minesweeper master
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

include_once('MinesweeperTile.php');

class MinesweeperBoard
{
	private $board;
	private $numRows;
	private $numCols;
	private $mineCount = 0;

	public function __construct($rows, $cols)
	{
		$this->numRows = $rows;
		$this->numCols = $cols;
		$this->board = array();
		for ($x = 0; $x < $cols; $x++)
		{
			for ($y = 0; $y < $rows; $y++)
			{
				$this->board[$x][$y] = new MinesweeperTile();
			}
		}
	}

	public function __clone()
	{
		//clone all of the tiles
		for ($x = 0; $x < $this->numCols; $x++)
		{
			for ($y = 0; $y < $this->numRows; $y++)
			{
				$this->board[$x][$y] = clone $this->board[$x][$y];
			}
		}
	}

	public function display()
	{
		for ($y = 0; $y < $this->numRows; $y++)
		{
			for ($x = 0; $x < $this->numCols; $x++)
			{
				$this->board[$x][$y]->display();
			}
			echo "\n";
		}
	}

	public function setMineAt($x, $y)
	{
		$this->checkIfValidLocation($x, $y);
		if ($this->board[$x][$y]->hasMine()) {
			throw new Exception("there's already a mine at ({$x}, {$y})");
		}
		$this->board[$x][$y]->setAsMine();
		$this->mineCount++;
	}

	public function getMineCount()
	{
		return $this->mineCount;
	}

	public function clickAt($x, $y)
	{
		$this->checkIfValidLocation($x, $y);
		$this->board[$x][$y]->clicked();
		$neighbors = $this->getNeighborCoords($x, $y);
		foreach ($neighbors as $neighbor) {
			$this->flip($neighbor['x'], $neighbor['y']);
		}
	}
	
	private function flip($x, $y) 
	{
		if ($this->board[$x][$y]->hasMine() || $this->board[$x][$y]->hasBeenFlipped()) return;
		$neighbors = $this->getNeighborCoords($x, $y);

		$numMinesNearby = 0;
		foreach ($neighbors as $neighbor) {
			if ($this->board[$neighbor['x']][$neighbor['y']]->hasMine()) 
			{
				$numMinesNearby++;
			}
		}
		
		
		$this->board[$x][$y]->flip($numMinesNearby);

		foreach ($neighbors as $neighbor) {
			$neighborNeighbors = $this->getNeighborCoords($neighbor['x'], $neighbor['y']);
			$neighborNumMinesNearby = 0;
			foreach ($neighborNeighbors as $neighborNeighbor) {
				if ($this->board[$neighborNeighbor['x']][$neighborNeighbor['y']]->hasMine()) 
				{
					$neighborNumMinesNearby++;
				}
			}
			if ($numMinesNearby == 0 ) {
				$this->flip($neighbor['x'], $neighbor['y']);
			}
			
		}
		
		
	}

	public function getCoordsWithNoMinedNeighbors()
	{
		$noMinedNeighbors = array();
		foreach ($this->board as $x => $col)
		{
			foreach ($col as $y => $tile)
			{
				$neighbors = $this->getNeighborCoords($x, $y);
				$mine = FALSE;
				foreach ($neighbors as $coord)
				{
					$this->checkIfValidLocation($coord['x'], $coord['y']);
					if ($this->board[$coord['x']][$coord['y']]->hasMine())
					{
						$mine = TRUE;
						break;
					}
				}
				if ($mine === FALSE) 
				{
					$noMinedNeighbors[] = array('x'=>$x, 'y'=>$y);
				}
			}
		}
		foreach ($noMinedNeighbors as $key => $coord) 
		{
			if ($this->board[$coord['x']][$coord['y']]->hasMine()) {
				unset($noMinedNeighbors[$key]);
			}
		}
		return $noMinedNeighbors;
	}

	private function getNeighborCoords($x, $y)
	{
		$coords = array();
		$upExists = ($y != 0);
		$rightExists = ($x != ($this->numCols - 1));
		$leftExists = ($x != 0);
		$downExists = ($y != ($this->numRows - 1));

		if ($upExists) {
			$coords[] = array('x' => $x, 'y' => ($y - 1));
		}
		if ($upExists && $rightExists) {
			$coords[] = array('x' => ($x + 1), 'y' => ($y - 1));
		}
		if ($upExists && $leftExists) {
			$coords[] = array('x' => ($x - 1), 'y' => ($y - 1));
		}
		if ($rightExists) {
			$coords[] = array('x' => ($x + 1), 'y' => $y);
		}
		if ($leftExists) {
			$coords[] = array('x' => ($x - 1), 'y' => $y);
		}
		if ($downExists) {
			$coords[] = array('x' => $x, 'y' => ($y + 1));
		}
		if ($downExists && $rightExists) {
			$coords[] = array('x' => ($x + 1), 'y' => ($y + 1));
		}
		if ($downExists && $leftExists) {
			$coords[] = array('x' => ($x - 1), 'y' => ($y + 1));
		}
		
		return $coords;
	}

	private function checkIfValidLocation($x, $y)
	{
		if ($x > $this->numCols || $x < 0) {
			throw new InvalidArgumentException("x value of $x out of bounds. num rows: {$this->numCols}");
		}
		if ($y > $this->numRows|| $y < 0) {
			throw new InvalidArgumentException("y value of $y out of bounds. num cols: {$this->numRows}");
		}
	}

	public function isSolved()
	{
		$solved = true;
		$clicked = false;
		foreach ($this->board as $col)
		{
			foreach ($col as $tile)
			{
				// if ($tile->hasMine() && $tile->hasBeenFlipped())
				// {
				// 	$solved = false;
				// }
				if ( ! $tile->hasMine() && ! ($tile->hasBeenFlipped() || $tile->hasBeenClicked()))
				{
					$solved = false;
				}
				if ($clicked == FALSE) {
					$clicked = $tile->hasBeenClicked();
				}
			}
		}
		return $solved && $clicked;
	}
}

<?php

/**
 * completed for google jam 2014
 * problem c: minesweeper master
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

class MinesweeperTile
{
	private $mine = false;
	private $clicked = false;
	private $flipped = false;
	private $text;
	private $showNumNeighbors = true;

	public function hasMine()
	{
		return $this->mine;
	}

	public function setAsMine()
	{
		$this->mine = true;
	}

	public function hasBeenClicked()
	{
		return $this->clicked;
	}

	public function __toString()
	{
		$str = '.';
		if ( ! is_null($this->text) && $showNumNeighbors && $this->hasBeenFlipped()) 
		{
			$str = $this->text;
		}
		elseif ($this->hasMine())
		{
			$str = '*';
		}
		elseif($this->hasBeenClicked())
		{
			$str = 'c';
		}
		return $str;
	}

	public function hasBeenFlipped()
	{
		return $this->flipped;
	}

	public function flip($numMinesNearby)
	{
		$this->text = $numMinesNearby;
		$this->flipped = true;
	}

	public function clicked()
	{
		if ($this->hasMine()) {
			throw new Exception("clicked a tile with a mine!");
		}
		$this->clicked = true;
	}

}

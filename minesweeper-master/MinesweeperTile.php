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

	public function display()
	{
		if ( ! is_null($this->text)) 
		{
			echo $this->text;
		}
		elseif ($this->hasMine())
		{
			echo '*';
		}
		elseif($this->hasBeenClicked())
		{
			echo 'c';
		}
		elseif($this->hasBeenFlipped())
		{
			echo '.';
		}
		else
		{
			echo '.';
		}
	}

	public function hasBeenFlipped()
	{
		return $this->flipped;
	}

	public function flip($numMinesNearby)
	{
		//$this->text = $numMinesNearby;
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

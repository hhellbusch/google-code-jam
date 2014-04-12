<?php

/**
 * completed for google jam 2014
 * problem a: magic trick
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

class Deal
{
	public $answer;
	private $rows = array();
	private $cardsSet = array();
	public function __construct()
	{

	}

	public function setNextRow($rowOfCards)
	{
		$cards = explode(" ", $rowOfCards);
		if (count($cards) != 4) {
			echo 'not enough cards in the row';
			return false;
		}
		foreach ($cards as $card) {
			if ( ! in_array($card, $this->cardsSet)) {
				$this->cardsSet[] = $card;
			} else {
				echo 'the card ' . $card . ' is already in the play field';
				return false;
			}
		}

		$this->rows[] = $cards;
	}
	//row num is between 1 and 4
	public function getRow($rowNum) 
	{
		if ($rowNum < 1 || $rowNum > 4) {
			throw new InvalidArgumentException("the row num has to be between 1 and 4 - given: " . $rowNum);
		}
		return $this->rows[$rowNum - 1];
	}
}

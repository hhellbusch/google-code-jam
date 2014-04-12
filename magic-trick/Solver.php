<?php

/**
 * completed for google jam 2014
 * problem a: magic trick
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

class Solver
{
	private $deals;
	public function __construct(array $deals)
	{
		$this->deals = $deals;
	}

	public function solve()
	{
		$caseNum = 1;
		$iMax = count($this->deals) / 2;
		for ($i = 0; $i < $iMax; $i++)
		{
			$firstDeal = array_shift($this->deals);
			$secondDeal = array_shift($this->deals);
			$intersection = array_intersect($firstDeal->getRow($firstDeal->answer), $secondDeal->getRow($secondDeal->answer));
			echo "Case #{$caseNum}: ";
			if (count($intersection) == 0) 
			{
				echo "Volunteer cheated!";
			}
			elseif (count($intersection) == 1)
			{
				echo current($intersection);
			}
			else
			{
				echo "Bad magician!";
			}
			echo "\n";
			$caseNum++;
		}

	}
}

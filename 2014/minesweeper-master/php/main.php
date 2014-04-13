<?php

/**
 * completed for google jam 2014
 * problem c: minesweeper master
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

include_once ('MinesweeperOneClickSolver.php');

function main($args)
{
	if (count($args) == 0) 
	{
		echo 'Usage: php main.php [name of input file]';
		return;
	}
	$file = $args[0];
	if (! file_exists($file)) 
	{
		echo 'File ' . $file . ' does not exist.';
		return;
	}
	$input = file_get_contents($file);
	$lines = explode("\n", $input);
	//parse the input
	$numCases = array_shift($lines);
	$scenarios = array();
	for ($i = 0; $i < $numCases; $i++)
	{
		$input = explode(" ", $lines[$i]);
		$numMines = $input[2];
		$numCols = $input[1];
		$numRows = $input[0];
		$scenario = new MinesweeperOneClickSolver($numMines, $numRows, $numCols);
		$caseNum = $i + 1;

		echo "Case #{$caseNum}:\n";
		$scenario->solveWithOneClick();
	}
	

	//create a solver
	//solve
}

array_shift($argv);
main($argv);

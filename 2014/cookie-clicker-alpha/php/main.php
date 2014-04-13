<?php
/**
 * completed for google jam 2014
 * problem b: cookie clicker
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */
include ('CookieClickerSolver.php');

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
	//get the input and run it
	$input = file_get_contents($file);
	$lines = explode("\n", $input);
	$numCases = array_shift($lines);
	
	for ($i = 0; $i < $numCases; $i++)
	{
		$input = explode(" ", $lines[$i]);
		$scenario = new CookieClickerSolver();
		$scenario->setCostOfFarm($input[0]);
		$scenario->setFarmRate($input[1]);
		$scenario->setGoal($input[2]);
		$caseNum = $i + 1;
		echo "Case #{$caseNum}: {$scenario->getTimeToReachGoal()}\n";
	}
}

array_shift($argv);
main($argv);
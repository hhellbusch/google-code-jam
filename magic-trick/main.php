<?php

/**
 * completed for google jam 2014
 * problem a: magic trick
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

include ("Deal.php");
include ("Solver.php");

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
	//validate the number of cases
	if ($numCases <= 0 || $numCases > 100) {
		echo 'Too many cases! Must be between 1 and 100 (inclusive).  Was given ' . $numCases . ' cases.';
	}
	$numCases = $numCases*2;
	$linesPerCase = 5;
	$cases = array();
	$case = null;

	for ($i = 0; $i < $numCases * $linesPerCase; $i++) 
	{
		if ($i % $linesPerCase == 0) {
			$case = new Deal();
			$result = $case->answer = $lines[$i];
			if ($result === FALSE) return;
		}
		else
		{
			$result = $case->setNextRow($lines[$i]);
			if ($result === FALSE) return;
		}
		if ($i % $linesPerCase == $linesPerCase - 1) {
			$cases[] = $case;
		}
	}
	$solver = new Solver($cases);
	$solver->solve();
}

array_shift($argv);
main($argv);

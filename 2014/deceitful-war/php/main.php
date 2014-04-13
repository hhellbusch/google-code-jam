<?php

/**
 * completed for google jam 2014
 * problem d: deceitful war
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */



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
	$i = 0;
	$scenarios = array();
	$index = 0;
	foreach ($lines as $line)
	{
		if ($i % 3 == 0) {
			//blocks per person, dont need to store this
			continue;
		}
		if ($i % 3 == 1) {
			//naomi
			$naomi = explode(' ', $line);
			$scenarios[$index]['naomi'] = $naomi;
		}
		if ($i % 3 == 2) {
			$ken = explode(' ', $line);
			$scenarios[$index]['ken'] = $ken;
			$index++;
		}
		$i++;
	}

	//naomi knows all weights, ken only knows his
	foreach ($scenarios as $game) 
	{
		//play the game
		
	}
}

array_shift($argv);
main($argv);

<?php

/**
 * completed for google jam 2014
 * problem b: cookie clicker
 * Author: Henry Hellbusch hhellbusch@gmail.com
 */

class CookieClickerSolver
{
	private $costOfFarm;
	private $cookiesPerSecond = 2;
	private $farmRate;
	private $goal;
	private $seconds = 0;

	public function setCostOfFarm($costOfFarm)
	{
		$this->costOfFarm = $costOfFarm;
	}

	public function setFarmRate($farmRate)
	{
		$this->farmRate = $farmRate;
	}

	public function setGoal($goal)
	{
		$this->goal = $goal;
	}

	public function getTimeToReachGoal()
	{
		if (is_null($this->costOfFarm) || is_null($this->farmRate) || is_null($this->goal))
		{
			throw new Exception("class not initialized properly");
		}
		
		$time = 0;
		while(true)
		{
			$timeToWait = $this->calculateTimeToWinAtCurrentRate();
			$timeToWaitWithOneMoreFarm = $this->calculateTimeToWinWithOneMoreFarm();
			if ($timeToWait < $timeToWaitWithOneMoreFarm) {
				$time += $timeToWait;
				break;
			}
			$time += $this->calculateTimeToBuyFarm();
			//"buy" a farm
			$this->cookiesPerSecond += $this->farmRate;
		}
		return number_format($time, 7);
	}

	private function calculateTimeToWinAtCurrentRate()
	{
		return $this->goal / $this->cookiesPerSecond;
	}

	private function calculateTimeToWinWithOneMoreFarm()
	{
		return $this->calculateTimeToBuyFarm() + ($this->goal / ($this->farmRate + $this->cookiesPerSecond));
	}

	private function calculateTimeToBuyFarm()
	{
		return $this->costOfFarm / $this->cookiesPerSecond;
	}

}

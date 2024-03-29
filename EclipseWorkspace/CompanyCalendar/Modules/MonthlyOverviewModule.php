<?php
	require_once("DataAccess/EventData.php");
	class Day
	{
		public $eventList;
		public $dayOfMonth;
		public $current;
		
		function __construct($day)
		{
			$this->dayOfMonth = $day;
		}
	}

	class MonthlyOverviewModule
	{
		public $eventDataAccessor;
		
		function __construct()
		{
			$this->eventDataAccessor = new EventDataAccessor();
		}
		
		function BuildModel($month, $year)
		{
			$firstDay = new DateTime($year . '/' . $month . '/01');
			$totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			
			$week = 0;
			$dayOfWeek = $firstDay->format('w');
			$calendar = array(5);
			
			$model = array();
			
			for ($dayOfMonth = 1; $dayOfMonth <= $totalDays; $dayOfMonth++)
			{
				$day = new Day($dayOfMonth);
				$day->eventList = $this->eventDataAccessor->GetEventsByDay($dayOfMonth, $month, $year);
				if (date('d') == $dayOfMonth && date('m') == $month && date('Y') == $year)
				{
					$day->current = true;
				}
				else
				{
					$day->current = false;
				}
				
				$model['days'][$week][$dayOfWeek] = $day;
				
				$dayOfWeek++;
				if ($dayOfWeek % 7 == 0)
				{
					$week++;
					$dayOfWeek = 0;
				}
			}
			
			$model['currentYear'] = $year;
			
			$model['nextMonth'] = $month + 1;
			$model['previousMonth'] = $month - 1;
			$model['nextYear'] = $year;
			$model['previousYear'] = $year;
			
			if ($month == 12)
			{
				$model['nextMonth'] = 1;
				$model['nextYear'] = $year + 1;
			}
			else if ($month == 1)
			{
				$model['previousMonth'] = 12;
				$model['previousYear'] = $year - 1;
			}
			
			return $model;
		}
	}
?>
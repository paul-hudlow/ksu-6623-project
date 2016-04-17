<?php
	require_once("DataAccess/EventData.php");
	require_once("DataAccess/UserData.php");
	require_once("DataAccess/EventCategoryData.php");
	
	class ReportsModule
	{
		public $eventDataAccessor;
		public $userDataAccessor;
		public $eventCategoryDataAccessor;
		
		function __construct()
		{
			$this->eventDataAccessor = new EventDataAccessor();
			$this->userDataAccessor = new UserDataAccessor();
			$this->eventCategoryDataAccessor = new EventCategoryDataAccessor();
		}
		
		function BuildModel($year, $month, $employeeId, $categoryId)
		{
			if (empty($month))
			{
				$this->BuildModelForYear($year, $employeeId, $categoryId);
			}
			else
			{
				$this->BuildModelForMonth($year, $month, $employeeId, $categoryId);
			}
		}
		
		function BuildModelForYear($year, $employeeId, $categoryId)
		{
			$model = array();
			
			$allEvents = $this->eventDataAccessor->GetEventsForYear($year, $categoryId, $employeeId);
			$monthlyEvents = $this->DivideMonths($allEvents);
			
			foreach ($monthlyEvents as $monthName=>$monthEvents)
			{
				$workTime = $this->CountWorkTime($monthEvents);
				if ($workTime > 0)
				{
					$model['monthlyTime'][$monthName] = $workTime;
				}
			}
			$model['totalTime'] = $this->CountWorkTime($allEvents);
			
			return $model;
		}
		
		function BuildModelForMonth($year, $month, $employeeId, $categoryId)
		{
			$model = array();
			
			$allEvents = $this->eventDataAccessor->GetEventsForMonth($year, $month, $employeeId, $categoryId);
			
			foreach ($allEvents as $event)
			{
				$workTime = GetWorkTimeInHours($event);
				if ($workTime > 0)
				{
					$model['events'][] = $event;
				}
			}

			$model['totalTime'] = $this->CountWorkTime($allEvents);
			
			return $model;
		}
		
		function DivideMonths($eventList)
		{
			$monthlyEvents = array();
			foreach ($eventList as $event)
			{
				$monthlyEvents[$event->startDate->format('F')][] = $event;
			}
			return $monthlyEvents;
		}
		
		function CountWorkTime($eventList)
		{
			$totalTime = 0.0;
			
			foreach ($eventList as $event)
			{
				$totalTime += GetWorkTimeInHours($event);
			}
			return $totalTime;
		}
		
		function GetWorkTimeInHours($event)
		{
			return $event->workTime->h + (float)($event->workTime->i) / 60;
		}
	}
?>
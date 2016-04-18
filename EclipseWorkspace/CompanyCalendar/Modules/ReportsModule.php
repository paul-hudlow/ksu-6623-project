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
				$newModel = $this->BuildModelForYear($year, $employeeId, $categoryId);
				$newModel['period'] = 'year';
			}
			else
			{
				$newModel = $this->BuildModelForMonth($year, $month, $employeeId, $categoryId);
				$newModel['period'] = 'month';
			}
			$newModel['categories'] = $this->eventCategoryDataAccessor->GetAllCategories();
			$newModel['employees'] = $this->userDataAccessor->GetAllUsers();
			$newModel['currentYear'] = date('Y');
		
			$newModel['selectedYear'] = $year;
			$newModel['selectedMonth'] = $month;
			$newModel['selectedEmployee'] = $employeeId;
			$newModel['selectedCategory'] = $categoryId;
			
			for ($i = 1; $i <= 12; $i++)
			{
				$monthDateTime = new DateTime("2000-$i-01");
				$newModel['allMonths'][$i] = $monthDateTime->format('F');
			}
			
			return $newModel;
		}
		
		function BuildModelForYear($year, $employeeId, $categoryId)
		{
			$model = array();
			
			$allEvents = $this->eventDataAccessor->GetEventsForYear($year, $employeeId, $categoryId);
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

			$model['totalTime'] = $this->CountWorkTime($allEvents);
			
			foreach ($allEvents as $event)
			{
				$workTime = $this->GetWorkTimeInHours($event);
				if ($workTime > 0)
				{
					$event->workTime = $workTime; // Update event object with string instead of DateInterval.
					$model['events'][] = $event;
				}
			}
			
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
				$totalTime += $this->GetWorkTimeInHours($event);
			}
			return $totalTime;
		}
		
		function GetWorkTimeInHours($event)
		{
			return $event->workTime->h + (float)($event->workTime->i) / 60;
		}
	}
?>
<?php

	class ReportsModule
	{
		public $eventDataAccessor;
		public $userDataAccessor;
		public $eventCategoryDataAccessor;
		
		function __construct()
		{
			$eventDataAccessor = new EventDataAccessor();
			$userDataAccessor = new UserDataAccessor();
			$eventCategoryDataAccessor = new EventCategoryDataAccessor();
		}
		
		function BuildModelForYear($year, $employeeId, $categoryId)
		{
			$model = array();
			
			$allEvents = $this->eventDataAccessor->GetEventsForYear($year, $categoryId, $employeeId);
			$monthlyEvents = $this->DivideMonths($allEvents);
			
			foreach ($monthlyEvents as $monthEvents)
			{
				$model['monthlyTime'] = $this->CountWorkTime($monthEvents);
			}
			$model['totalTime'] = $this->CountWorkTime($allEvents);
			
			return $model;
		}
		
		function BuildModelForMonth($year, $month, $employeeId, $categoryId)
		{
			$model = array();
			
			$model['events'] = $this->eventDataAccessor->GetEventsForMonth($year, $month, $categoryId, $employeeId);
			$model['totalTime'] = $this->CountWorkTime($allEvents);
			
			return $model;
		}
		
		function DivideMonths($eventList)
		{
			$monthlyEvents = array(12);
			foreach ($eventList as $event)
			{
				$monthlyEvents[$event->format('m')][] = $event;
			}
			return $monthlyEvents;
		}
		
		function CountWorkTime($eventList)
		{
			$totalTime = 0;
			foreach ($eventList as $events)
			{
				$totalTime += $event->workTime;
			}
			return $totalTime;
		}
	}
?>
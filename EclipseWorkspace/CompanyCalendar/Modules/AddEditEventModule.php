<?php
	require_once("DataAccess/UserData.php");
	require_once("DataAccess/EventData.php");
	
	class AddEditEventModule
	{
		function __construct()
		{
			$this->userData = new UserDataAccessor();
			$this->eventData = new EventDataAccessor();
			$this->categoryData = new EventCategoryDataAccessor();
		}
		
		function BuildModel($year, $month, $day, $eventId=NULL)
		{
			$model = array();
			
			$model["year"]	= $year;
			$model["month"] = $month;
			$model["day"]	= $day;
						
			$model["Users"] = $this->userData->GetAllUsers();
			$model["Categories"] = $this->categoryData->GetAllCategories();
			
			if ($eventId != NULL)
			{
				error_log("AddEditEventModel GetEvent: " . $eventId);
				$model["Event"] = $this->eventData->GetEventById($eventId);
			}
			else 
			{
				error_log("AddEditEventModel empty event");
				//create empty event as a place holder
				$emptyEvent = new Event();
				$emptyEvent->employee = new User();
				$emptyEvent->category = new EventCategory();
				
				$model["Event"] = $emptyEvent;
			}
			
			return $model;
		}
		
		function SaveEvent()
		{
			$event = new Event();
			
			$event->title		= $_GET['title'];
			$event->description = $_GET['description'];
			$event->category	= $_GET['category'];
			$event->employee	= $_GET['employee'];
			$event->startDate	= $_GET['startDate'];
		 	$event->endDate		= $_GET['endDate'];
		 	$event->workTime	= $_GET['workTime'];
			
			return $this->eventData->SaveEvent($event);
		}
	}
?>
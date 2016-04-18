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
				$emptyEvent->startDate = $year . "-" . $month . "-" . $day;
				$emptyEvent->endDate = $year . "-" . $month . "-" . $day;
				
				$model["Event"] = $emptyEvent;
			}
			
			return $model;
		}
		
		function SaveEvent()
		{
			$event = new Event();
			
			$category = new EventCategory();
			$category->id = $_GET['category'];
			
			$employee = new User();
			$employee->userName = $_GET['employee'];
			
			$event->eventId     = $_GET['eventid'];
			$event->title		= $_GET['title'];
			$event->description = $_GET['description'];
			$event->category	= $category;
			$event->employee	= $employee;
			$event->startDate	= $_GET['start_date'];
		 	$event->endDate		= $_GET['end_date'];
		 	$event->workTime	= $_GET['hours_of_time'];
			
			return $this->eventData->SaveEvent($event);
		}
		
		function DeleteEvent($eventId)
		{
			$this->eventData->DeleteEvent($eventId);
		}
	}
?>
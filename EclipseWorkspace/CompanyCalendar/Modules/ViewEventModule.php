<?php
	require_once("DataAccess/EventData.php");
	class ViewEventModule
	{
		public $eventDataAccessor;
		
		function __construct()
		{
			$this->eventDataAccessor = new EventDataAccessor();
		}
		
		function BuildModel($eventId)
		{
			$model = array();
			$eventObject = $this->eventDataAccessor->GetEventById($eventId);
			$model["event_title"] = $eventObject->title;
			$model["event_description"] = $eventObject->description;
			$model["event_start_date"] = $eventObject->startDate->format('h:i m/d/Y');
			$model["event_end_date"] = $eventObject->endDate->format('h:i m/d/Y');
			$model["event_category"] = $eventObject->category->title;
			$model["employee"] = $eventObject->employee->firstName . ' ' . $eventObject->employee->lastName;
			$model["work_time"] = $eventObject->workTime->format('%h:%i');
			
			return $model;
		}
	}
?>
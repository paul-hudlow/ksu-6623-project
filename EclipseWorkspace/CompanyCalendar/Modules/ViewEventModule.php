<?php
	include("DataAccess/EventData.php");
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
			$model["event_start_date"] = $eventObject->startDate;
			$model["event_end_date"] = $eventObject->endDate;
			$model["employee"] = $eventObject->employee->firstName . ' ' . $eventObject->employee->lastName;
			
			return $model;
		}
	}
?>
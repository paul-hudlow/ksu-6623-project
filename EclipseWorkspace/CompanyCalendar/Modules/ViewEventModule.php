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
			$model["event_start_date"] = $eventObject->startDate->format('h:ia F d, Y');
			$model["event_end_date"] = $eventObject->endDate->format('h:ia F d, Y');
			$model["event_category"] = $eventObject->category->title;
			if (isset($eventObject->employee))
			{
				$model["employee"] = $eventObject->employee->firstName . ' ' . $eventObject->employee->lastName;
			}
			if (isset($eventObject->workTime))
			{
				$model["work_time"] = $eventObject->workTime->format('%h:%i');
			}
			
			return $model;
		}
	}
?>
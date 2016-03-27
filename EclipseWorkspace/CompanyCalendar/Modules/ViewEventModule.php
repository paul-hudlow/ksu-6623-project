<?php
	include("DataAccess/EventData.php");
	class ViewEventModule
	{
		static function BuildModel()
		{
			$model = array();
			$eventId = $_GET["eventid"];
			$eventObject = EventDataAccessor::GetEventById($eventId);
			$model["title"] = $eventObject->title;
			$model["description"] = $eventObject->description;
			$model["date"] = $eventObject->date;
			
			return $model;
		}
	}
?>
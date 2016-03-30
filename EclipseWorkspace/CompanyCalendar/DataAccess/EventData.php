<?php
	require_once('Connector/DatabaseConnector.php');
	
	class Event
	{
		public $eventID;
		public $title;
		public $description;
		public $startDate;
		public $endDate;
		public $category;
		public $employee;
		public $hours;
	}
	
	class EventDataAccessor
	{
		static function GetEventsForMonth($monthYear)
		{
			$eventArray = array();
			
			//query database for all the events for given month
			
			return $eventArray;
		}
		
		static function GetEventByDayMonthYear($day, $monthYear)
		{
			$returnEvent = null;

			//query database for the specific event
			
			return $returnEvent;
		}
		
		static function GetEventById($id)
		{
			$database = DatabaseConnector::GetDatabase();
			$returnEvent = new Event;
			$data = $database->select("event", "*", array("id" => 0));
			$returnEvent->title = $data[0]["title"];
			$returnEvent->description = $data[0]["description"];
			$returnEvent->date = $data[0]["date"];
			
			return $returnEvent;
		}
		
		static function SaveEvent($event)
		{
			$retVal = false;
			
			//query to save the event information
			
			return $retVal;
		}
	}
?>
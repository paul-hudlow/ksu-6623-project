<?php
	require_once('Connector/DatabaseConnector.php');
	require_once('UserData.php');
	require_once('EventCategoryData.php');
	
	class Event
	{
		public $eventID;
		public $title;
		public $description;
		public $startDate;
		public $endDate;
		public $category;
		public $employee;
		public $workTime;
	}
	
	class EventDataAccessor
	{
		public $userDataAccessor;
		public $eventCategoryDataAccessor;
		private $database;
		
		function __construct()
		{
			$this->userDataAccessor = new UserDataAccessor();
			$this->eventCategoryDataAccessor = new EventCategoryDataAccessor();
			$this->database = DatabaseConnector::GetDatabase();
		}
		
		function GetEventsForMonth($monthYear)
		{
			$eventArray = array();
			
			//query database for all the events for given month
			
			return $eventArray;
		}
		
		function GetEventByDayMonthYear($day, $monthYear)
		{
			$returnEvent = null;

			//query database for the specific event
			
			return $returnEvent;
		}
		
		function GetEventById($id)
		{
			$returnEvent = new Event();
			$data = $this->database->select("event", "*", array("id" => $id));
			
			$returnEvent->title = $data[0]["title"];
			$returnEvent->description = $data[0]["description"];
			$returnEvent->startDate = $data[0]["start_date"];
			$returnEvent->endDate = $data[0]["end_date"];
			$returnEvent->workTime = $data[0]["work_time"];
			$returnEvent->category = $this->eventCategoryDataAccessor->GetEventCategoryById($data[0]["category"]);
			$returnEvent->employee = $this->userDataAccessor->GetUserById($data[0]["employee"]);
			
			return $returnEvent;
		}
		
		function SaveEvent($event)
		{
			$retVal = false;
			
			//query to save the event information
			
			return $retVal;
		}
	}
?>
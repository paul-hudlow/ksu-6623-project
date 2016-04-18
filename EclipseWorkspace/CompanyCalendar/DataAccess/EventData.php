<?php
	require_once('Connector/DatabaseConnector.php');
	require_once('UserData.php');
	require_once('EventCategoryData.php');
	
	class Event
	{
		public $eventId;
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
			$data = $this->database->select("event", "*", array("id" => $id));
			
			return $this->MapEventFromData($data[0]);
		}
		
		function GetEventsByDay($day, $month, $year)
		{
 			$dateTime = new DateTime($year . '/' . $month . '/' . $day);
			$dayStart = $dateTime->format('Y-m-d') . ' 00:00:00';
			$dayEnd = $dateTime->format('Y-m-d')  . ' 59:59:59';
			$data = $this->database->select("event", "*", array("AND" => array("start_date[<=]" => $dayEnd, "end_date[>=]" => $dayStart)));
			$eventList = array();
			foreach ($data as $datum)
			{
				$eventList[] = $this->MapEventFromData($datum);
			}
			return $eventList;
		}
		
		function MapEventFromData($data)
		{
			$returnEvent = new Event();
			
			$returnEvent->eventId = $data['id'];
			$returnEvent->title = $data["title"];
			$returnEvent->description = $data["description"];
			$returnEvent->startDate = $data["start_date"];
			$returnEvent->endDate = $data["end_date"];
			$returnEvent->workTime = $data["work_time"];
			$returnEvent->category = $this->eventCategoryDataAccessor->GetEventCategoryById($data["category"]);
			if (!($data["employee"] == null || $data["employee"] == ""))
			{
				$returnEvent->employee = $this->userDataAccessor->GetUserById($data["employee"]);
			}
			
			return $returnEvent;
		}
		
		function SaveEvent($event)
		{
			$retVal = false;
			
			$dataArray = array(
					"id" => $event->eventId,
					"title" => $event->title,
					"description" => $event->description,
					"start_date" => $event->startDate,
					"end_date" => $event->endDate,
					"category" => $event->category->id,
					"employee" => $event->employee->userName,
					"work_time" => $event->workTime,
			);
			
			if ($event->eventId != NULL)
			{
				//update
				$this->database->update("event", $dataArray, ["id" => $event->eventId]);
			}
			else
			{
				//insert
				$max = $this->database->max("event", "id");
				$dataArray['id'] = $max + 1;
				$this->database->insert("event", $dataArray);
			}
			
			return $retVal;
		}
		
		function DeleteEvent($eventId)
		{
			$this->database->delete("event", ["id" => $eventId]);
		}
	}
?>
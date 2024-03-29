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
		
		function GetEventsForMonth($year, $month, $employeeId, $categoryId)
		{
 			$monthStartString = $year . '-' . $month . '-1' . ' 00:00:00';
			$totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$monthEndString = $year . '-' . $month . '-' . $totalDays . ' 23:59:59';
			
			return $this->GetEventsForTimePeriod($monthStartString, $monthEndString, $employeeId, $categoryId);
		}
		
		function GetEventsForYear($year, $employeeId, $categoryId)
		{		
 			$yearStartString = $year . '-1-1' . ' 00:00:00';
			$yearEndString = $year . '-12-31' . ' 23:59:59';
			
			return $this->GetEventsForTimePeriod($yearStartString, $yearEndString, $employeeId, $categoryId);
		}
		
		function GetEventsForTimePeriod($yearStartString, $yearEndString, $employeeId, $categoryId)
		{
			$whereClause = array("start_date[>=]" => $yearStartString, "start_date[<=]" => $yearEndString);
			
			if (!empty($categoryId))
			{
				$whereClause['category'] = $categoryId;
			}
			
			if (!empty($employeeId))
			{
				$whereClause['employee'] = $employeeId;
			}
			
			$data = $this->database->select("event", "*", array("AND" => $whereClause, "ORDER" => array("start_date")));
			
			$eventList = array();
			foreach ($data as $datum)
			{
				$eventList[] = $this->MapEventFromData($datum);
			}
			return $eventList;
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
			$dayStart = $year . '-' . $month . '-' . $day . ' 00:00:00';
			$dayEnd = $year . '-' . $month . '-' . $day . ' 23:59:59';
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
			$returnEvent->startDate = new DateTime($data["start_date"]);
			$returnEvent->endDate = new DateTime($data["end_date"]);
			if (isset($data["work_time"]))
			{
				$baseDateTime = new DateTime('00:00:00');
				$workDateTime = new DateTime($data["work_time"]);
				$returnEvent->workTime = $baseDateTime->diff($workDateTime);
			}
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
					"work_time" => $event->workTime->format("%H:%M:%S"),
			);
			
			if ($dataArray["employee"] == "")
			{
				$dataArray["employee"] = NULL;
			}
			
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
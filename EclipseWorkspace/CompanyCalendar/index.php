<?php
	include "Models/userdata.php";
	include "Models/eventdata.php";

	$page = $_GET["page"];
	$action = $_GET["action"];
	
	$template = "";
	$model = array();
	
	// determine user and permissions
	$user = getCurrentUser();
	
	// determine page that is being asked for
	switch( strtoupper($page) )
	{
		case "CALENDAR" :
			doCalendar();
			break;
			
		case "EVENT" :
			doEvent();
			break;
					
		default:
			$template = "Views/notfound.php";
			
	}
	
	require_once($template);
	
	// determine page actions
	function doCalendar()
	{
		global $template;
		global $model;
		global $action;
		
		$template = "Views/calendar.php";
		
		$monthYear = $_GET["monthyear"];
		if (empty($monthYear) || $monthYear == "")
		{
			$monthYear = date("mY");
		}
		
		$model["monthYear"] = $monthYear;
		$model["events"] = getEventsForMonth($monthYear);		
	}
	
	function doEvent()
	{
		global $template;
		global $model;
		global $action;
		
		switch( strtoupper($action) )
		{
			case "DISPLAY" :
				$eventId = $_GET["eventid"];
				$template = "Views/event.php";
				$model["event"] = getEventById($eventId);
				break;
				
			case "SAVE" :
				$currentEvent = new Event();
				$currentEvent->day = $_GET["day"];
				$currentEvent->month = $_GET["month"];
				
				$bResult = saveEvent($currentEvent);
				
				if ($bResult)
				{
					$template = "Views/calendar.php";
					$resultMessage = "Event has been saved.";
				}
				else
				{
					$template = "Views/event.php";
					$resultMessage = "Failed to save event.";
				}
				
				$model["event"] = $currentEvent;
				$model["resultMessage"] = $resultMessage;
				break;
			
			case "CANCEL" :
				$template = "Views/calendar.php";
				break;
		}
	}	
	
?>
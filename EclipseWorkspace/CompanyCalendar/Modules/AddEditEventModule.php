<?php
/* Code pulled out of controller
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
*/
	class AddEditEventModule
	{
		static function BuildModel()
		{
			$model = array();
			
			return $model;
		}
	}
?>
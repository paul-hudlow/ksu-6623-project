<?php
/* Code pulled out of controller
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
	$model["events"] = getEventsForMonth($monthYear);'
*/
	class MonthlyOverviewModule
	{
		static function BuildModel()
		{
			$model = array();
			
			return $model;
		}
	}
?>
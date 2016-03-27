<?php
	include("Modules/ViewEventModule.php");
	include("Modules/MonthlyOverviewModule.php");
	include("Modules/AddEditEventModule.php");
		
	$page = $_GET["page"];
	$action = $_GET["action"];

	global $model;
	
	// determine page that is being asked for
	switch( strtoupper($page) )
	{
		case "MONTHLY_OVERVIEW" :
			$model = MonthlyOverviewModule::BuildModel();
			$template = "Views/MonthlyOverviewView.php";
			break;
			
		case "VIEW_EVENT" :
			$model = ViewEventModule::BuildModel();
			$template = "Views/ViewEventView.php";
			break;
			
		case "ADD_EDIT_EVENT" :
			$model = AddEditEventModule::BuildModel();
			$template = "Views/AddEditEventView.php";
			break;
					
		default:
			$template = "Views/NotFoundView.php";
	}
	
	require_once($template);
?>
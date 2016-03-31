<?php
	include("Modules/LoginModule.php");
	include("Modules/ViewEventModule.php");
	include("Modules/MonthlyOverviewModule.php");
	include("Modules/AddEditEventModule.php");
	include("Modules/ReportsModule.php");
		
	$page = $_GET["page"];

	global $model;
	
	// determine page that is being asked for
	switch( strtoupper($page) )
	{
		case "LOGIN" :
			$loginSuccess = LoginModule::Login();
			if ($loginSuccess)
			{
				header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?page=monthly_overview');
				die();
			}
			else
			{
				$model = LoginModule::BuildModel();
				$template = "Views/LoginView.php";
			}
			break;
			
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
			
		case "REPORTS" :
			$model = ReportsModule::BuildModel();
			$template = "Views/ReportsView.php";
			break;
			
		default:
			$template = "Views/NotFoundView.php";
	}
	
	require_once($template);
?>
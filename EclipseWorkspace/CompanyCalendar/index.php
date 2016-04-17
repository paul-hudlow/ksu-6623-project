<?php
	require_once("Modules/LoginModule.php");
	require_once("Modules/ViewEventModule.php");
	require_once("Modules/MonthlyOverviewModule.php");
	require_once("Modules/AddEditEventModule.php");
	require_once("Modules/ReportsModule.php");

	$page = $_GET['page'];
	$action = $_GET['action'];

	global $model;
	
	if (!sses_running())
	{
		sses_start();
	}
	
	$loginModule = new LoginModule();
	
	if (strtoupper($action) == "LOGOUT")
	{
		$loginModule->Logout();
	}
	
	// Handle special login behavior.
	if (strtoupper($page) == "LOGIN")
	{
		if (LoginModule::LoggedIn())
		{
			LoginModule::ForwardFromLogin();
			die();
		}
		if (isset($_POST['username']))
		{
			$loginSuccess = $loginModule->Login($_POST['username'], $_POST['password']);
			if ($loginSuccess)
			{
				$loginModule->ForwardFromLogin();
				die();
			}
			else
			{
				$model = $loginModule->BuildModel(true);
			}
		}
		else
		{
			$model = $loginModule->BuildModel(false);
		}
		$template = "Views/LoginView.php";
	}
	else
	{
		if (!LoginModule::LoggedIn())
		{
			LoginModule::ForwardToLogin();
			die();
		}
		
		switch( strtoupper($page) )
		{
			case "MONTHLY_OVERVIEW" :
				$monthlyOverviewModule = new MonthlyOverViewModule();
				$model = $monthlyOverviewModule->BuildModel($_GET['month'], $_GET['year']);
				$template = "Views/MonthlyOverviewView.php";
				break;
				
			case "VIEW_EVENT" :
				$viewEventModule = new ViewEventModule();
				$model = $viewEventModule->BuildModel($_GET['event_id']);
				$template = "Views/ViewEventView.php";
				break;
				
			case "ADD_EDIT_EVENT" :
				$model = AddEditEventModule::BuildModel();
				$template = "Views/AddEditEventView.php";
				break;
				
			case "REPORTS" :
				$reportsModule = new ReportsModule();
				$model = $reportsModule->BuildModel($_GET['year'], $_GET['month'], $_GET['employee'], $_GET['category']);
				$template = "Views/ReportsView.php";
				break;
			
			case "REPORT_SUMMARY" :
				//$model = ReportsModule::BuildModel();
				$template = "Views/ReportSummary.php";
				break;
				
			default:
				$template = "Views/NotFoundView.php";
		}
	}
	
	require_once($template);
?>

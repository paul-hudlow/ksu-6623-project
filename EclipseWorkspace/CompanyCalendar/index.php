<?php
	require_once("Modules/LoginModule.php");
	require_once("Modules/ViewEventModule.php");
	require_once("Modules/MonthlyOverviewModule.php");
	require_once("Modules/AddEditEventModule.php");
	require_once("Modules/ReportsModule.php");

	$page = $_GET['page'];
	$action = "";
	if (isset($_GET['action']))
	{
		$action = $_GET['action'];
	}

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
				if (isset($_GET['month']) && isset($_GET['year']))
				{
					$month = $_GET['month'];
					$year = $_GET['year'];
				}
				else
				{
					$month = date('m');
					$year = date('Y');
				}
				$model = $monthlyOverviewModule->BuildModel($month, $year);
				$template = "Views/MonthlyOverviewView.php";
				break;
				
			case "VIEW_EVENT" :
				$viewEventModule = new ViewEventModule();
				$model = $viewEventModule->BuildModel($_GET['event_id']);
				$template = "Views/ViewEventView.php";
				break;
				
			case "ADD_EDIT_EVENT" :
				//case 1: display the blank template in anticipation of creating a new event
				//case 2: display existing event
				//case 3: save an event then display the month overview the event was saved on
				//case 4: cancel event edit, so display the month overview
				//case 5: delete the given event
				
				$eventModel = new AddEditEventModule();

				if (!$_SESSION['HR'])
				{
					header('Location: ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?page=view_event&event_id=' . $_GET["event_id"]);
					die();
				}
				
				if (strtoupper($action) == "")
				{
					error_log("ADD_EDIT_EVENT: display");
					
					if(isset($_GET["event_id"]))
					{
						//case 2
						$model = $eventModel->BuildModel($_GET["year"], $_GET["month"], NULL, $_GET["event_id"]);
					}
					else 
					{
						//case 1
						$model = $eventModel->BuildModel($_GET["year"], $_GET["month"], $_GET["day"]);
					}
					
					$template = "Views/AddEditEventView.php";
				}
				else
				{
					error_log("ADD_EDIT_EVENT: " . $action);
					
					if (strtoupper($action) == "SAVE")
					{
						//case 3
						$eventModel->SaveEvent();
					}
					else if (strtoupper($action) == "CANCEL")
					{
						//case 4
					}
					else if (strtoupper($action) == "DELETE")
					{
						//case 5
						$eventModel->DeleteEvent($_GET["event_id"]);
					}
					
					die('<script type="text/javascript">window.location.href="index.php?page=monthly_overview&year=' . $_GET['year']  . '&month=' . $_GET['month'] . '";</script>');
					
					// always return to the overview
					//$monthlyOverviewModule = new MonthlyOverViewModule();
					//$model = $monthlyOverviewModule->BuildModel($_GET['month'], $_GET['year']);
					//$template = "Views/MonthlyOverviewView.php";
				}				
				
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

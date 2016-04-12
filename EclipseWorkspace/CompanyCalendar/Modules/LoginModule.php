<?php
	class LoginModule
	{
		private $ulogin;
		
		function __construct()
		{
			$this->ulogin = new uLogin();
		}
		
		function BuildModel($failedAttempt)
		{
			$model = array();
			if ($failedAttempt)
			{
				$model['error'] = "Login failed.";
			}
			
			return $model;
		}
		
		function Login($username, $password)
		{
			$this->ulogin->Authenticate($username,  $password);
			if ($this->ulogin->IsAuthSuccess()){
				$_SESSION['uid'] = $this->ulogin->Uid();
				$_SESSION['username'] = $username;
				$_SESSION['loggedIn'] = true;
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function Logout()
		{
			$this->ulogin->Logout($_SESSION['uid']);
			unset($_SESSION['uid']);
			unset($_SESSION['username']);
			unset($_SESSION['loggedIn']);
		}
		
		static function ForwardFromLogin()
		{
			if (isset($_SESSION['start']))
			{
				$start = $_SESSION['start'];
				unset($_SESSION['start']);
			}
			else 
			{
				$start = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?page=monthly_overview';
			}
			header('Location: ' . $start);
		}
		
		static function ForwardToLogin()
		{
			$_SESSION['start'] = $_SERVER['REQUEST_URI'];
			header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . '?page=login');
		}
		
		static function LoggedIn()
		{
			return isset($_SESSION['uid']) && isset($_SESSION['username']) && isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn']===true);
		}
	}
?>
<?php
	require_once('Connector/DatabaseConnector.php');

	class User
	{
		public $userName;
		public $firstName;
		public $lastName;
		public $isHR;
	}

	function getCurrentUser()
	{
		return new User;
	}
	
	class UserDataAccessor
	{	
		static function GetUserByUserName($userName)
		{
			$database = DatabaseConnector::GetDatabase();
			$returnUser = new User;
			$data = $database->select("user", "*", array("user_name" => $userName));
			$returnUser->userName = $data[0]["user_name"];
			$returnUser->firstName = $data[0]["first_name"];
			$returnUser->lastName = $data[0]["last_name"];
			$returnUser->isHR = $data[0]["is_hr"];
			
			return $returnUser;
		}
	}
?>
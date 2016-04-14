<?php
	require_once('Connector/DatabaseConnector.php');

	class User
	{
		public $userName;
		public $firstName;
		public $lastName;
		public $isHR;
	}
	
	class UserDataAccessor
	{
		function GetUserById($userId)
		{
			$database = DatabaseConnector::GetDatabase();
			$returnUser = new User();
			$data = $database->select("user", "*", array("username" => $userId));
			
			$returnUser->userName = $data[0]["username"];
			$returnUser->firstName = $data[0]["first_name"];
			$returnUser->lastName = $data[0]["last_name"];
			$returnUser->isHR = $data[0]["role"];
			
			return $returnUser;
		}
	}
?>
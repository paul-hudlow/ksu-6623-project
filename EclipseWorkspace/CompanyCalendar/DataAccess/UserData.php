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
?>
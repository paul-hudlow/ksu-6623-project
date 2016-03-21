<?php
	function getCurrentUser()
	{
		return new User;
	}
	
	class User
	{
		public $firstName;
		public $lastName;
		public $isHR = false;
	}
?>
<?php
	class LoginModule
	{
		static function BuildModel()
		{
			$model = array();
			
			return $model;
		}
		
		static function Login()
		{
			return $_GET["action"] == 'login';
		}
	}
?>
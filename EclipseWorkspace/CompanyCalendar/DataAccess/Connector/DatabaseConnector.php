<?php
	require_once('medoo.php');
	
	class DatabaseConnector
	{
		private static $database = NULL;
		
		static function GetDatabase()
		{
			if (self::$database == NULL)
			{
				self::$database = new medoo(array(
				    'database_type' => 'mysql',
				    'database_name' => 'CompanyCalendar',
				    'server' => 'localhost',
				    'username' => 'root',
				    'password' => 'swe6623',
				    'charset' => 'utf8'
				));
			}
			return self::$database;
		}
	}
?>
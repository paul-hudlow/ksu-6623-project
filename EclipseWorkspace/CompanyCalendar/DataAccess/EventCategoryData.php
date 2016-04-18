<?php
	require_once('Connector/DatabaseConnector.php');

	class EventCategory
	{
		public $id;
		public $title;
		public $includeHours;
		public $color;
	}
	
	class EventCategoryDataAccessor
	{
		private $database;
		
		function __construct()
		{
			$this->database = DatabaseConnector::GetDatabase();
		}
		
		function GetEventCategoryById($id)
		{
			$returnCategory = new EventCategory();
			$data = $this->database->select("category", "*", array("id" => $id));
			
			$returnCategory->id = $data[0]['id'];
			$returnCategory->title = $data[0]['title'];
			$returnCategory->includeHours = $data[0]['work_time'];
			$returnCategory->color = $data[0]['color'];
			
			return $returnCategory;
		}
		
		function GetAllCategories()
		{
			$allCategories = array();
			
			$data = $this->database->select("category", "*");
			
			foreach($data as $row)
			{
				$curCat = new EventCategory();
				
				$curCat->id				= $row["id"];
				$curCat->colorCode		= $row["color"];
				$curCat->includeHours	= $row["work_time"];
				$curCat->title			= $row["title"];
				
				$allCategories[] = $curCat;
			}
			
			return $allCategories;
		}
	}
?>

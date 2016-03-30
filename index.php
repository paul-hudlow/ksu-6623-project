<?php

if(!isset($_SESSION)){
	header("Location:login.php");
}
else {
	header("Location:calendar.php");
}

?>
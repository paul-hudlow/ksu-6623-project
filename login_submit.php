<?php

require_once("admin_user_data.php");
$userdata = new admin_data();

$username = $_POST['username'];
$password = $_POST['password'];

$confirmation = $userdata->login($username, $password);
echo $confirmation;


?>
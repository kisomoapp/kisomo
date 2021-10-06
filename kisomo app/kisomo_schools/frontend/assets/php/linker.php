<?php

  // header("Access-Control-Allow-Origin: https://dashboard.kisomo.co.tz");
  
  date_default_timezone_set("Africa/Nairobi");
 	$hostname = "localhost";
	$databaseName = "kisomo_offline";
	$userName = "root";
	$password = "";


	$conn = mysqli_connect($hostname,$userName,$password,$databaseName);

  if(!$conn){   
    die('Connect error('. mysqli_connect_errno(). ')'. mysqli_connect_error());
  }
  if (session_status() === PHP_SESSION_NONE) 
  {
    session_start();
  }

?>

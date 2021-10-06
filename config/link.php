<?php
    $hostname = "localhost";
	  $databaseName = "kisomo_Offline";
  	$userName = "root";
  	$password = "";
  	$conn = mysqli_connect($hostname,$userName,$password,$databaseName);
  if(!$conn){   
    die('Connect error('. mysqli_connect_errno(). ')'. mysqli_connect_error());
  }
  session_start();
?>

<?php
    require "linker.php";
    if (session_status() === PHP_SESSION_NONE) 
    {
      session_start();
    }
   
    if(isset($_SESSION['current_token']) && isset($_SESSION['userId']))
    {
        $current_token=$_SESSION['current_token'];
        $userId=(int)$_SESSION['userId'];
        $res = mysqli_query($conn , "SELECT `user_token`, `user_id` FROM `users_token` WHERE user_id=$userId");


        $row=mysqli_fetch_assoc($res);
        $db_token=$row['user_token'];
     
        if(!($db_token==$current_token))
        {
            echo "expired";
        }  

    }
    else
    {
        echo "expired";
    }
?>


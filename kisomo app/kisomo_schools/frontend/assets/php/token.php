<?php

    require "linker.php";

    $userId=(int)$_SESSION['userId'];
  
    $token=rand(100000,10000000);

    $res = mysqli_query($conn , "SELECT `user_token`, `user_id` FROM `users_token` WHERE user_id=$userId");

    if( mysqli_num_rows($res) > 0 )
    {

   
            
            // update token

            $res = mysqli_query($conn ,"UPDATE users_token SET user_token=$token WHERE `user_id`=$userId");
          
            if($res)
            {
               $_SESSION['current_token']=$token;
               echo "success";
            }
            else
            {
                echo "error";
            }


    }
    else
    {
        // create new token for that user
        $res = mysqli_query($conn , "INSERT INTO users_token( user_token, user_id) VALUES ( $token, $userId)");

        if($res)
        {
            $_SESSION['current_token']=$token;
            echo "success";
        }
        else
        {
            echo "error";
        }

        
    }


?>






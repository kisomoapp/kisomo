<?php
    require 'linker.php';
    if(isset($_SESSION['userId']))
    {
        if($_SESSION['userId']!="")
        {
            $userId=$_SESSION['userId'];
            $res=mysqli_query($conn,"SELECT email FROM `users`  WHERE user_id=$userId");
            if(mysqli_num_rows($res)>0)
            {
                $row=mysqli_fetch_assoc($res);
                $email=$row['email'];
                echo $email;
            }
            else
            {
                echo "error";
            }
        }
    }
?>
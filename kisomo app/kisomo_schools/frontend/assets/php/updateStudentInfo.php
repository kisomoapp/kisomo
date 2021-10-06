
<?php
    session_start();
    require 'linker.php';
    if(isset($_SESSION['userId']))
    {
        $userId=$_SESSION['userId'];
    }
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $password=$_POST['password'];
        $email=$_POST['email'];
        if($_POST['password']!="")
        {
            $password=md5($password);
            $sql="UPDATE users SET email=?,password=? WHERE  user_id=?";
            $statement=$conn->prepare($sql);
            $statement->bind_param('ssi',$email,$password,$userId);
            $res=$statement->execute(); 
            $statement->close(); 
        }
    }
    if(isset($_POST['email']) )
    {
        $email=$_POST['email'];
        $sql="UPDATE `users` SET `email`=? WHERE  user_id=?";
        $statement=$conn->prepare($sql);
        $statement->bind_param('si',$email,$userId);
        $res=$statement->execute(); 
        $statement->close(); 
    }
    if($res)
    {
        echo "success";
    }
    else
    {
        echo "error";
    }
?>
 


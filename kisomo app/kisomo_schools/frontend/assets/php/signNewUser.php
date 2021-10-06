<?php

require 'linker.php';

$email=$_POST['email'];

 $sql1="SELECT user_id FROM `users` WHERE email=?";
 
 $stmt1=$conn->prepare($sql1);
 $stmt1->bind_param('s',$email);     
 $stmt1->execute();
 $res1=$stmt1->get_result();
 $stmt1 -> close();
 if(mysqli_num_rows($res1) > 0)
 {
    echo "exist";
 }

 else
 {


        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fullname']) 
        && isset($_POST['gender']) && isset($_POST['phone']) && isset($_POST['who'])  )
    {

    $email=$_POST['email'];
    $fullname=$_POST['fullname'];
    $password=md5($_POST['password']);
    $gender=$_POST['gender'];
    $who=$_POST['who'];
    $phone=$_POST['phone'];
    $verified="T";

    $sql="INSERT INTO users( fullname, phone, email,password,gender,account_type, verified)
        VALUES (?,?,?,?,?,?,?)";


    $statement=$conn->prepare($sql);
    $statement->bind_param('sssssss', $fullname,$phone,$email,$password,$gender,$who,$verified);
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

 }



?>
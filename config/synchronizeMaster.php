<?php
include ('link.php');
header("Access-Control-Allow-Origin: *");
date_default_timezone_set("Africa/Nairobi");
//$dateTime= date("Y-m-d h:i:sa");

if
    (

            isset($_POST['schoolCode']) &&
            isset($_POST['dateTime']) &&
            isset($_POST['action']) &&
            isset($_POST['duration']) &&
            isset($_POST['student_login_id'])
        )
{
    $schoolCode=$_POST['schoolCode'];
    $dateTime=$_POST['dateTime'];
    $action=$_POST['action'];
    $duration=$_POST['duration'];
    $studentLoginId=$_POST['student_login_id'];
    if($conn)
    {
        $res = mysqli_query($conn ,
                            "INSERT INTO logs_server( school_code,student_login_id,'action',duration,start_time) 
                            VALUES ('$schoolCode', '$studentLoginId', '$action','$duration','$dateTime')");
        if($res)
            echo "success";
        else
            echo "error";
    }
    else
    {
        echo "error";
    }
}
else
{
    echo "error";
}

?>

<?php
include ('link.php');
$logId=(int)$_POST['logId'];
$sync_status='T';
if($conn)
{
    $res = mysqli_query($conn ,"UPDATE student_logs SET sync_status='$sync_status' 
    WHERE log_id=$logId"); 
}    
?>

<?php
include ('link.php');
date_default_timezone_set("Africa/Nairobi");
$dateTime= date("Y-m-d h:i:s");

if($conn)
{
    $res = mysqli_query($conn ,"SELECT ss.school_login_id,l.log_id,l.school_code,l.action,l.duration,l.date 
                                    FROM student_logs l,school_students ss 
                                    where l.user_id=ss.user_id and  l.sync_status='F' and l.commited='T'"); 
    if(mysqli_num_rows($res) > 0)
    {

        while( ($row = mysqli_fetch_array($res)) != null )
        {
            $log_data= array(
                        'log_id' =>(int)$row['log_id'],
                        'school_code'=>$row['school_code'],
                        'action'=>$row['action'],
                        'duration'=>$row['duration'],
                        "dateTime"=>$row['date'],
                        "school_login_id"=>$row['school_login_id'],
                    );
            $logs_data[]=$log_data;
            $data= array("logs_data"=>$logs_data);
        }
        echo json_encode($data);
    }
    else
    {
        echo "empty";
    }
}
?>


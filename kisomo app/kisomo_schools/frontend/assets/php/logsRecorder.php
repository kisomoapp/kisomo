<?php
date_default_timezone_set("Africa/Nairobi");
require 'linker.php';
if (session_status() === PHP_SESSION_NONE) 
{
  session_start();
}
function recordStudentTopicLogs($action)
{
    if(isset($_SESSION['userId']) && isset($_SESSION['school_code']))
    {
        $hostname = "localhost";
        $databaseName = "kisomo_offline";
        $userName = "root";
        $password = "";
        $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
        $school_code=$_SESSION['school_code'];
        $userId=(int)$_SESSION['userId'];
        $syncStatus="F";
        $log_time=date("Y-m-d h:i:sa");
        $topicLogged=$_SESSION['topic_logged'];
        $res=mysqli_query($conn,"INSERT INTO student_logs(user_id, school_code,action,date,sync_status) 
        VALUES ($userId,'$school_code','$action','$log_time','$syncStatus')");
        if($res)
        {
            $res=mysqli_query($conn,"SELECT log_id FROM student_logs 
            WHERE user_id=$userId and commited='F' and action like '%$topicLogged%'");  
            $row=mysqli_fetch_assoc($res);
            $_SESSION['topic_current_log_id']=$row['log_id'];
        }
    }
}
function updateTopicRecordSetDuration()
{
    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);

    $log_to_be_updated=$_SESSION['topic_current_log_id'];

    $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['topic_opened_at']);
    $duration=round((abs($duration)/(60)),2);
    $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration' ,commited='T'
    where log_id=$log_to_be_updated and commited='F'");
}

// signin logs
function recordSigninLog($action)
{
    if(isset($_SESSION['userId']) && isset($_SESSION['school_code']))
    {
        $hostname = "localhost";
        $databaseName = "kisomo_offline";
        $userName = "root";
        $password = "";
        $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
        $school_code=$_SESSION['school_code'];
        $userId=(int)$_SESSION['userId'];
        $syncStatus="F";
        $log_time=date("Y-m-d h:i:sa");
        $commited="F";
        $res=mysqli_query($conn,"INSERT INTO student_logs(user_id, school_code,action,date,sync_status) 
        VALUES ($userId,'$school_code','$action','$log_time','$syncStatus')");
        if($res)
        {
            $actionLike="logged in";
            $res=mysqli_query($conn,"SELECT log_id FROM student_logs 
            WHERE user_id=$userId and commited='$commited' and action like '%$actionLike%'");  
            $row=mysqli_fetch_assoc($res);
            $_SESSION['signin_logged_id']=$row['log_id'];
            $_SESSION['signin_start_time']=$log_time;
        }
    }
}
function recordLoggedInDuration()
{
    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    $commited='F';
    $log_to_be_updated=$_SESSION['signin_logged_id'];

    $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['signin_start_time']);
    $duration=round((abs($duration)/(60)),2);
    $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration' ,commited='T'
    where log_id=$log_to_be_updated and commited='$commited'");
}
//end of signin logs

// Module logs
function recordStudentModuleLogs($action)
{
    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    $school_code=$_SESSION['school_code'];
    $userId=(int)$_SESSION['userId'];
    $syncStatus="F";
    $log_time=date("Y-m-d h:i:sa");
    $moduleLogged=$_SESSION['module_logged'];
    $res=mysqli_query($conn,"INSERT INTO student_logs(user_id, school_code,action,date,sync_status) 
    VALUES ($userId,'$school_code','$action','$log_time','$syncStatus')");
    if($res)
    {
        $res=mysqli_query($conn,"SELECT log_id FROM student_logs 
        WHERE user_id=$userId and  commited='F' and action like '%$moduleLogged%' and action like '%video%'");  
        $row=mysqli_fetch_assoc($res);
        $_SESSION['module_current_log_id']=$row['log_id'];
    } 
}

function recordModuleDuration()
{
    if(isset($_SESSION['module_current_log_id']))
    {
        $hostname = "localhost";
        $databaseName = "kisomo_offline";
        $userName = "root";
        $password = "";
        $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    
        $log_to_be_updated=$_SESSION['module_current_log_id'];
    
        $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['module_opened_at']);
        $duration=round((abs($duration)/(60)),4);
        $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration' , commited='T'
        where log_id=$log_to_be_updated and  commited='F'");
        $_SESSION['module_current_log_id']="";
    }

}
//end of module logs

// quiz logs

function recordStudentQuizLogs($action)
{
    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    $school_code=$_SESSION['school_code'];
    $userId=(int)$_SESSION['userId'];
    $syncStatus="F";
    $log_time=date("Y-m-d h:i:sa");
    $quizLogged=$_SESSION['quiz_logged'];
    $res=mysqli_query($conn,"INSERT INTO student_logs(user_id, school_code,action,date,sync_status) 
    VALUES ($userId,'$school_code','$action','$log_time','$syncStatus')");
    if($res)
    {
        $res=mysqli_query($conn,"SELECT log_id FROM student_logs 
        WHERE user_id=$userId and  commited='F' and action like '%$quizLogged%'");  
        $row=mysqli_fetch_assoc($res);
        $_SESSION['quiz_current_log_id']=$row['log_id'];
    } 
}

function recordQuizDuration()
{
    if(isset($_SESSION['quiz_current_log_id']))
    {
        $hostname = "localhost";
        $databaseName = "kisomo_offline";
        $userName = "root";
        $password = "";
        $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    
        $log_to_be_updated=$_SESSION['quiz_current_log_id'];
        $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['quiz_opened_at']);
        $duration=round((abs($duration)/(60)),4);
        $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration', commited='T' 
        where log_id=$log_to_be_updated and  commited='F'");
    }

}
// end of quiz log

function setQuizCompleted($score)
{

    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);

    $log_to_be_updated=$_SESSION['quiz_current_log_id'];

    //select action of the log to be updated
    $res=mysqli_query($conn,"select action from  student_logs 
    where log_id=$log_to_be_updated and  commited='F'");

    $row=mysqli_fetch_assoc($res);
    $action=$row['action'];
    $completedAction=$action." ".":scored ".$score."%";
    //end
    $res=mysqli_query($conn,"UPDATE `student_logs` SET action='$completedAction' ,commited='T'
    where log_id=$log_to_be_updated and commited='F'");
}

// news log

function recordNewsLog($action)
{

    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    
    $school_code=$_SESSION['school_code'];
    $userId=(int)$_SESSION['userId'];
    $syncStatus="F";
    $log_time= $_SESSION['news_opened_at'];

    $res=mysqli_query($conn,"INSERT INTO student_logs(user_id, school_code,action,date,sync_status) 
    VALUES ($userId,'$school_code','$action','$log_time','$syncStatus')");
    if($res)
    {
        $res=mysqli_query($conn,"SELECT log_id FROM student_logs 
        WHERE user_id=$userId and  commited='F' and action like '%$action%'");  
        $row=mysqli_fetch_assoc($res);
        $_SESSION['news_log_id']=$row['log_id'];
        $_SESSION['lock_news_timer']=1;
    } 


}
function recordNewsLogDuration()
{
    $_SESSION['lock_news_timer']=0;

    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);

    $log_to_be_updated=$_SESSION['news_log_id'];

    $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['news_opened_at']);
    $duration=round((abs($duration)/(60)),4);
    $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration', commited='T'
    where log_id=$log_to_be_updated and  commited='F'");
}

// end of news log

// news log

function recordCalendarLog($action)
{

    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    
    $school_code=$_SESSION['school_code'];
    $userId=(int)$_SESSION['userId'];
    $syncStatus="F";
    $log_time= $_SESSION['calendar_opened_at'];

    $res=mysqli_query($conn,"INSERT INTO student_logs(user_id, school_code,action,date,sync_status) 
    VALUES ($userId,'$school_code','$action','$log_time','$syncStatus')");
    if($res)
    {
        $res=mysqli_query($conn,"SELECT log_id FROM student_logs 
        WHERE user_id=$userId and  commited='F' and action like '%$action%'");  
        $row=mysqli_fetch_assoc($res);
        $_SESSION['calendar_log_id']=$row['log_id'];
        $_SESSION['lock_calendar_timer']=1;
    } 


}
function recordCalendarLogDuration()
{
    $_SESSION['lock_calendar_timer']=0;

    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);

    $log_to_be_updated=$_SESSION['calendar_log_id'];

    $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['calendar_opened_at']);
    $duration=round((abs($duration)/(60)),4);
    $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration', commited='T'
    where log_id=$log_to_be_updated and  commited='F'");
}

// end of calendar log

// start of auto function

// function auto recorder start here
function signinDurationAutoRecorder()
{
    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    $commited='F';
    $log_to_be_updated=$_SESSION['signin_logged_id'];

    $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['signin_start_time']);
    $duration=round((abs($duration)/(60)),2);
    $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration' 
    where log_id=$log_to_be_updated and commited='$commited'");
}

// topic duration auto recorder
function topicDurationAutoRecorder()
{
    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);

    $log_to_be_updated=$_SESSION['topic_current_log_id'];

    $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['topic_opened_at']);
    $duration=round((abs($duration)/(60)),2);
    $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration'
    where log_id=$log_to_be_updated and commited='F'");
}


function autoModuleDurationRecorder()
{

    if(isset($_SESSION['module_current_log_id']))
    {
        $hostname = "localhost";
        $databaseName = "kisomo_offline";
        $userName = "root";
        $password = "";
        $conn = mysqli_connect($hostname,$userName,$password,$databaseName);

        $log_to_be_updated=$_SESSION['module_current_log_id'];
    
        $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['module_opened_at']);
        $duration=round((abs($duration)/(60)),4);
        $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration'
        where log_id=$log_to_be_updated and  commited='F'");
    }

}


// quiz duration auto recorder
function autoQuizDurationRecorder()
{
    if(isset($_SESSION['module_current_log_id']))
    {
        $hostname = "localhost";
        $databaseName = "kisomo_offline";
        $userName = "root";
        $password = "";
        $conn = mysqli_connect($hostname,$userName,$password,$databaseName);
    
        $log_to_be_updated=$_SESSION['quiz_current_log_id'];
        $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['quiz_opened_at']);
        $duration=round((abs($duration)/(60)),4);
        $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration'
        where log_id=$log_to_be_updated and  commited='F'");
    }
}


//news auto timer
function autoNewsLogDurationRecorder()
{

    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);

    $log_to_be_updated=$_SESSION['news_log_id'];

    $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['news_opened_at']);
    $duration=round((abs($duration)/(60)),4);
    $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration'
    where log_id=$log_to_be_updated and  commited='F'");
}

// calendar auto timer
function autoCalendarLogDurationRecorder()
{

    $hostname = "localhost";
    $databaseName = "kisomo_offline";
    $userName = "root";
    $password = "";
    $conn = mysqli_connect($hostname,$userName,$password,$databaseName);

    $log_to_be_updated=$_SESSION['calendar_log_id'];

    $duration=strtotime(date("Y-m-d h:i:sa")) - strtotime($_SESSION['calendar_opened_at']);
    $duration=round((abs($duration)/(60)),4);
    $res=mysqli_query($conn,"UPDATE `student_logs` SET `duration`='$duration'
    where log_id=$log_to_be_updated and  commited='F'");
}

// end of auto function

?>




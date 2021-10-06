<?php
    session_start();
    //log
    date_default_timezone_set("Africa/Nairobi");
    include 'logsRecorder.php';
    $action="opened school calendar";
   
    if(isset($_SESSION['lock_calendar_timer']))
    {
        if(!($_SESSION['lock_calendar_timer']==1))
        {

            $_SESSION['calendar_opened_at']=date("Y-m-d h:i:sa");
            recordCalendarLog($action);
        }
    }
    else
    {
        $_SESSION['calendar_opened_at']=date("Y-m-d h:i:sa");
        recordCalendarLog($action);  
    }

    //

?>
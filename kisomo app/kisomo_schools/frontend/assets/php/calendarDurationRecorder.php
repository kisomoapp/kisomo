<?php
    session_start();
    include 'logsRecorder.php';
    if(isset($_SESSION['lock_calendar_timer']))
    {
        if($_SESSION['lock_calendar_timer']==1)
        {
            recordCalendarLogDuration();
        }
    }
?>